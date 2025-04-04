<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $table = 'site_settings';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function logo(): ?string
    {
        return $this->logo ?? null;
    }

    public function title(): ?string
    {
        return $this->title ?? null;
    }

    public function favicon(): ?string
    {
        return $this->favicon ?? null;
    }

    public function appkey(): ?string
    {
        return $this->appkey ?? null;
    }

    public function license_key(): ?string
    {
        return $this->license_key ?? null;
    }

    public function copyright(): ?string
    {
        return $this->copyright ?? null;
    }
}
