<?php

namespace App\Http\Controllers;

use App\Models\SiteSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Symfony\Component\Process\Process;

class InstallController extends Controller
{
    public function index()
    {
        return view('install.index');
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', 900);
        try {
            $host = $request->host;
            $port = $request->port;
            $db_user = $request->db_user;
            $db_name = $request->db_name;
            $db_password = $request->db_password;
            $mysqli = @new \mysqli($host, $db_user, $db_password);
            if ($mysqli->connect_error) {
                return response()->json(['msg' => 'Database connection failed: ' . $mysqli->connect_error]);
            }
            $db_check_query = "SHOW DATABASES LIKE '{$db_name}'";
            $result = $mysqli->query($db_check_query);
            if ($result->num_rows == 0) {
                $create_db_query = "CREATE DATABASE {$db_name}";
                if ($mysqli->query($create_db_query)) {
                    Log::info("Database created in server name : " . $db_name);
                } else {
                    return response()->json(['msg' => 'Failed to create the database: ' . $mysqli->error]);
                }
            }
            // Database exists, proceed with your normal logic
            $mysqli->close();
            $data['DB_HOST'] = $host;
            $data['DB_PORT'] = $port;
            $data['DB_DATABASE'] = $db_name;
            $data['DB_USERNAME'] = $db_user;
            $data['DB_PASSWORD'] = $db_password;
            $verification = validate_purchase($data);
            if ($verification === 'success') {
                return response()->json(['status' => true, 'msg' => 'Database Connection Success, Create Super Admin.', 'key' => encryptKey('abc', env('ENCRYPTION_KEY'))]);
            } elseif (! $verification) {
                return response()->json(['status' => false, 'msg' => 'Something went wrong. Please try again.']);
            } else {
                return response()->json(['status' => false, 'msg' => $verification]);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function final(Request $request)
    {
        try {
            if (isset($request->reset_database) && $request->reset_database == 1) {
                $this->envUpdates($request);
            } else {
                Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
                $this->dataInserts($request);
                $this->envUpdates($request);
            }
            return response()->json(['status' => true, 'msg' => 'Installation was Successful', 'url' => url('/')]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    protected function dataInserts($request): void
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'is_superadmin' => 1
        ]);
        $adminRole = Role::find(1);
        $user->assignRole($adminRole);
    }

    protected function envUpdates($request): void
    {
        try {
            envWriteNoPorts('APP_URL', URL::to('/'));
            envWrite('APP_INSTALLED', true);
            envWriteNoPorts('SESSION_DRIVER', 'database');
            Artisan::call('key:generate');
            Artisan::call('config:clear');
            sleep(5);
            DB::beginTransaction();
            $site = SiteSettings::find(1);
            if ($site) {
                Artisan::call('config:clear');
                Artisan::call('config:cache');
                sleep(5);
                $site->appkey = config('app.key');
                $site->save();
            } else {
                $site = new SiteSettings();
                Artisan::call('config:clear');
                Artisan::call('config:cache');
                sleep(5);
                $site->appkey = config('app.key');
                $site->title = "MB Super";
                $site->logo = "public/images/logo.svg";
                $site->favicon = "public/images/favicon-32x32.png";
                $site->copyright = "© All rights reserved";
                $site->save();
            }
            envWrite('APP_NAME', 'MB Super');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function UpdateSystem()
    {
        $username = env('GIT_USERNAME');
        $token = env('GIT_PAT');
        $repo = env('GIT_REPO');
        try {
            $process = new Process([
                'git',
                'pull',
                "https://{$username}:{$token}@{$repo}"
            ]);
            $process->setWorkingDirectory(base_path());
            $process->run();

            if (!$process->isSuccessful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Git pull failed',
                    'output' => $process->getErrorOutput()
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Code pulled successfully',
                'output' => $process->getOutput()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
