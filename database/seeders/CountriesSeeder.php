<?php

namespace Database\Seeders;

use App\Models\Countries;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        Countries::create([
            'id' => 1,
            'name' => 'Afghanistan',
            'iso3' => 'AFG',
            'iso2' => 'AF',
            'phonecode' => '93',
            'currency' => 'AFN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 2,
            'name' => 'Aland Islands',
            'iso3' => 'ALA',
            'iso2' => 'AX',
            'phonecode' => '358-18',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 3,
            'name' => 'Albania',
            'iso3' => 'ALB',
            'iso2' => 'AL',
            'phonecode' => '355',
            'currency' => 'ALL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 4,
            'name' => 'Algeria',
            'iso3' => 'DZA',
            'iso2' => 'DZ',
            'phonecode' => '213',
            'currency' => 'DZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 5,
            'name' => 'American Samoa',
            'iso3' => 'ASM',
            'iso2' => 'AS',
            'phonecode' => '1-684',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 6,
            'name' => 'Andorra',
            'iso3' => 'AND',
            'iso2' => 'AD',
            'phonecode' => '376',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 7,
            'name' => 'Angola',
            'iso3' => 'AGO',
            'iso2' => 'AO',
            'phonecode' => '244',
            'currency' => 'AOA',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 8,
            'name' => 'Anguilla',
            'iso3' => 'AIA',
            'iso2' => 'AI',
            'phonecode' => '1-264',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 9,
            'name' => 'Antarctica',
            'iso3' => 'ATA',
            'iso2' => 'AQ',
            'phonecode' => '672',
            'currency' => 'AAD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:31:40'
        ]);

        Countries::create([
            'id' => 10,
            'name' => 'Antigua And Barbuda',
            'iso3' => 'ATG',
            'iso2' => 'AG',
            'phonecode' => '1-268',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 11,
            'name' => 'Argentina',
            'iso3' => 'ARG',
            'iso2' => 'AR',
            'phonecode' => '54',
            'currency' => 'ARS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 12,
            'name' => 'Armenia',
            'iso3' => 'ARM',
            'iso2' => 'AM',
            'phonecode' => '374',
            'currency' => 'AMD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 13,
            'name' => 'Aruba',
            'iso3' => 'ABW',
            'iso2' => 'AW',
            'phonecode' => '297',
            'currency' => 'AWG',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 14,
            'name' => 'Australia',
            'iso3' => 'AUS',
            'iso2' => 'AU',
            'phonecode' => '61',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 15,
            'name' => 'Austria',
            'iso3' => 'AUT',
            'iso2' => 'AT',
            'phonecode' => '43',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 16,
            'name' => 'Azerbaijan',
            'iso3' => 'AZE',
            'iso2' => 'AZ',
            'phonecode' => '994',
            'currency' => 'AZN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 17,
            'name' => 'The Bahamas',
            'iso3' => 'BHS',
            'iso2' => 'BS',
            'phonecode' => '1-242',
            'currency' => 'BSD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 18,
            'name' => 'Bahrain',
            'iso3' => 'BHR',
            'iso2' => 'BH',
            'phonecode' => '973',
            'currency' => 'BHD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 19,
            'name' => 'Bangladesh',
            'iso3' => 'BGD',
            'iso2' => 'BD',
            'phonecode' => '880',
            'currency' => 'BDT',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 20,
            'name' => 'Barbados',
            'iso3' => 'BRB',
            'iso2' => 'BB',
            'phonecode' => '1-246',
            'currency' => 'BBD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 21,
            'name' => 'Belarus',
            'iso3' => 'BLR',
            'iso2' => 'BY',
            'phonecode' => '375',
            'currency' => 'BYN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 22,
            'name' => 'Belgium',
            'iso3' => 'BEL',
            'iso2' => 'BE',
            'phonecode' => '32',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 23,
            'name' => 'Belize',
            'iso3' => 'BLZ',
            'iso2' => 'BZ',
            'phonecode' => '501',
            'currency' => 'BZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 24,
            'name' => 'Benin',
            'iso3' => 'BEN',
            'iso2' => 'BJ',
            'phonecode' => '229',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 25,
            'name' => 'Bermuda',
            'iso3' => 'BMU',
            'iso2' => 'BM',
            'phonecode' => '1-441',
            'currency' => 'BMD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 26,
            'name' => 'Bhutan',
            'iso3' => 'BTN',
            'iso2' => 'BT',
            'phonecode' => '975',
            'currency' => 'BTN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 27,
            'name' => 'Bolivia',
            'iso3' => 'BOL',
            'iso2' => 'BO',
            'phonecode' => '591',
            'currency' => 'BOB',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 28,
            'name' => 'Bosnia and Herzegovina',
            'iso3' => 'BIH',
            'iso2' => 'BA',
            'phonecode' => '387',
            'currency' => 'BAM',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 29,
            'name' => 'Botswana',
            'iso3' => 'BWA',
            'iso2' => 'BW',
            'phonecode' => '267',
            'currency' => 'BWP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:31:40'
        ]);

        Countries::create([
            'id' => 30,
            'name' => 'Bouvet Island',
            'iso3' => 'BVT',
            'iso2' => 'BV',
            'phonecode' => '0055',
            'currency' => 'NOK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 31,
            'name' => 'Brazil',
            'iso3' => 'BRA',
            'iso2' => 'BR',
            'phonecode' => '55',
            'currency' => 'BRL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 32,
            'name' => 'British Indian Ocean Territory',
            'iso3' => 'IOT',
            'iso2' => 'IO',
            'phonecode' => '246',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 33,
            'name' => 'Brunei',
            'iso3' => 'BRN',
            'iso2' => 'BN',
            'phonecode' => '673',
            'currency' => 'BND',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 34,
            'name' => 'Bulgaria',
            'iso3' => 'BGR',
            'iso2' => 'BG',
            'phonecode' => '359',
            'currency' => 'BGN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 35,
            'name' => 'Burkina Faso',
            'iso3' => 'BFA',
            'iso2' => 'BF',
            'phonecode' => '226',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 36,
            'name' => 'Burundi',
            'iso3' => 'BDI',
            'iso2' => 'BI',
            'phonecode' => '257',
            'currency' => 'BIF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 37,
            'name' => 'Cambodia',
            'iso3' => 'KHM',
            'iso2' => 'KH',
            'phonecode' => '855',
            'currency' => 'KHR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 38,
            'name' => 'Cameroon',
            'iso3' => 'CMR',
            'iso2' => 'CM',
            'phonecode' => '237',
            'currency' => 'XAF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 39,
            'name' => 'Canada',
            'iso3' => 'CAN',
            'iso2' => 'CA',
            'phonecode' => '1',
            'currency' => 'CAD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 40,
            'name' => 'Cape Verde',
            'iso3' => 'CPV',
            'iso2' => 'CV',
            'phonecode' => '238',
            'currency' => 'CVE',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 41,
            'name' => 'Cayman Islands',
            'iso3' => 'CYM',
            'iso2' => 'KY',
            'phonecode' => '1-345',
            'currency' => 'KYD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 42,
            'name' => 'Central African Republic',
            'iso3' => 'CAF',
            'iso2' => 'CF',
            'phonecode' => '236',
            'currency' => 'XAF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 43,
            'name' => 'Chad',
            'iso3' => 'TCD',
            'iso2' => 'TD',
            'phonecode' => '235',
            'currency' => 'XAF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 44,
            'name' => 'Chile',
            'iso3' => 'CHL',
            'iso2' => 'CL',
            'phonecode' => '56',
            'currency' => 'CLP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 45,
            'name' => 'China',
            'iso3' => 'CHN',
            'iso2' => 'CN',
            'phonecode' => '86',
            'currency' => 'CNY',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 46,
            'name' => 'Christmas Island',
            'iso3' => 'CXR',
            'iso2' => 'CX',
            'phonecode' => '61',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 47,
            'name' => 'Cocos (Keeling) Islands',
            'iso3' => 'CCK',
            'iso2' => 'CC',
            'phonecode' => '61',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 48,
            'name' => 'Colombia',
            'iso3' => 'COL',
            'iso2' => 'CO',
            'phonecode' => '57',
            'currency' => 'COP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 49,
            'name' => 'Comoros',
            'iso3' => 'COM',
            'iso2' => 'KM',
            'phonecode' => '269',
            'currency' => 'KMF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 50,
            'name' => 'Congo',
            'iso3' => 'COG',
            'iso2' => 'CG',
            'phonecode' => '242',
            'currency' => 'XAF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 51,
            'name' => 'Democratic Republic of the Congo',
            'iso3' => 'COD',
            'iso2' => 'CD',
            'phonecode' => '243',
            'currency' => 'CDF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 52,
            'name' => 'Cook Islands',
            'iso3' => 'COK',
            'iso2' => 'CK',
            'phonecode' => '682',
            'currency' => 'NZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 53,
            'name' => 'Costa Rica',
            'iso3' => 'CRI',
            'iso2' => 'CR',
            'phonecode' => '506',
            'currency' => 'CRC',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 54,
            'name' => 'Cote DIvoire (Ivory Coast)',
            'iso3' => 'CIV',
            'iso2' => 'CI',
            'phonecode' => '225',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 55,
            'name' => 'Croatia',
            'iso3' => 'HRV',
            'iso2' => 'HR',
            'phonecode' => '385',
            'currency' => 'HRK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 56,
            'name' => 'Cuba',
            'iso3' => 'CUB',
            'iso2' => 'CU',
            'phonecode' => '53',
            'currency' => 'CUP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 57,
            'name' => 'Cyprus',
            'iso3' => 'CYP',
            'iso2' => 'CY',
            'phonecode' => '357',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 58,
            'name' => 'Czech Republic',
            'iso3' => 'CZE',
            'iso2' => 'CZ',
            'phonecode' => '420',
            'currency' => 'CZK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 59,
            'name' => 'Denmark',
            'iso3' => 'DNK',
            'iso2' => 'DK',
            'phonecode' => '45',
            'currency' => 'DKK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 60,
            'name' => 'Djibouti',
            'iso3' => 'DJI',
            'iso2' => 'DJ',
            'phonecode' => '253',
            'currency' => 'DJF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 61,
            'name' => 'Dominica',
            'iso3' => 'DMA',
            'iso2' => 'DM',
            'phonecode' => '1-767',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 62,
            'name' => 'Dominican Republic',
            'iso3' => 'DOM',
            'iso2' => 'DO',
            'phonecode' => '1-809',
            'currency' => 'DOP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 63,
            'name' => 'East Timor',
            'iso3' => 'TLS',
            'iso2' => 'TL',
            'phonecode' => '670',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 64,
            'name' => 'Ecuador',
            'iso3' => 'ECU',
            'iso2' => 'EC',
            'phonecode' => '593',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 65,
            'name' => 'Egypt',
            'iso3' => 'EGY',
            'iso2' => 'EG',
            'phonecode' => '20',
            'currency' => 'EGP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 66,
            'name' => 'El Salvador',
            'iso3' => 'SLV',
            'iso2' => 'SV',
            'phonecode' => '503',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 67,
            'name' => 'Equatorial Guinea',
            'iso3' => 'GNQ',
            'iso2' => 'GQ',
            'phonecode' => '240',
            'currency' => 'XAF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 68,
            'name' => 'Eritrea',
            'iso3' => 'ERI',
            'iso2' => 'ER',
            'phonecode' => '291',
            'currency' => 'ERN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 69,
            'name' => 'Estonia',
            'iso3' => 'EST',
            'iso2' => 'EE',
            'phonecode' => '372',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 70,
            'name' => 'Ethiopia',
            'iso3' => 'ETH',
            'iso2' => 'ET',
            'phonecode' => '251',
            'currency' => 'ETB',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 71,
            'name' => 'Falkland Islands',
            'iso3' => 'FLK',
            'iso2' => 'FK',
            'phonecode' => '500',
            'currency' => 'FKP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 72,
            'name' => 'Faroe Islands',
            'iso3' => 'FRO',
            'iso2' => 'FO',
            'phonecode' => '298',
            'currency' => 'DKK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 73,
            'name' => 'Fiji Islands',
            'iso3' => 'FJI',
            'iso2' => 'FJ',
            'phonecode' => '679',
            'currency' => 'FJD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 74,
            'name' => 'Finland',
            'iso3' => 'FIN',
            'iso2' => 'FI',
            'phonecode' => '358',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 75,
            'name' => 'France',
            'iso3' => 'FRA',
            'iso2' => 'FR',
            'phonecode' => '33',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 76,
            'name' => 'French Guiana',
            'iso3' => 'GUF',
            'iso2' => 'GF',
            'phonecode' => '594',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 77,
            'name' => 'French Polynesia',
            'iso3' => 'PYF',
            'iso2' => 'PF',
            'phonecode' => '689',
            'currency' => 'XPF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 78,
            'name' => 'French Southern Territories',
            'iso3' => 'ATF',
            'iso2' => 'TF',
            'phonecode' => '262',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 79,
            'name' => 'Gabon',
            'iso3' => 'GAB',
            'iso2' => 'GA',
            'phonecode' => '241',
            'currency' => 'XAF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 80,
            'name' => 'Gambia The',
            'iso3' => 'GMB',
            'iso2' => 'GM',
            'phonecode' => '220',
            'currency' => 'GMD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 81,
            'name' => 'Georgia',
            'iso3' => 'GEO',
            'iso2' => 'GE',
            'phonecode' => '995',
            'currency' => 'GEL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 82,
            'name' => 'Germany',
            'iso3' => 'DEU',
            'iso2' => 'DE',
            'phonecode' => '49',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 83,
            'name' => 'Ghana',
            'iso3' => 'GHA',
            'iso2' => 'GH',
            'phonecode' => '233',
            'currency' => 'GHS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 84,
            'name' => 'Gibraltar',
            'iso3' => 'GIB',
            'iso2' => 'GI',
            'phonecode' => '350',
            'currency' => 'GIP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 85,
            'name' => 'Greece',
            'iso3' => 'GRC',
            'iso2' => 'GR',
            'phonecode' => '30',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 86,
            'name' => 'Greenland',
            'iso3' => 'GRL',
            'iso2' => 'GL',
            'phonecode' => '299',
            'currency' => 'DKK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 87,
            'name' => 'Grenada',
            'iso3' => 'GRD',
            'iso2' => 'GD',
            'phonecode' => '1-473',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 88,
            'name' => 'Guadeloupe',
            'iso3' => 'GLP',
            'iso2' => 'GP',
            'phonecode' => '590',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 89,
            'name' => 'Guam',
            'iso3' => 'GUM',
            'iso2' => 'GU',
            'phonecode' => '1-671',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 90,
            'name' => 'Guatemala',
            'iso3' => 'GTM',
            'iso2' => 'GT',
            'phonecode' => '502',
            'currency' => 'GTQ',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 91,
            'name' => 'Guernsey and Alderney',
            'iso3' => 'GGY',
            'iso2' => 'GG',
            'phonecode' => '44-1481',
            'currency' => 'GBP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 92,
            'name' => 'Guinea',
            'iso3' => 'GIN',
            'iso2' => 'GN',
            'phonecode' => '224',
            'currency' => 'GNF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 93,
            'name' => 'Guinea-Bissau',
            'iso3' => 'GNB',
            'iso2' => 'GW',
            'phonecode' => '245',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 94,
            'name' => 'Guyana',
            'iso3' => 'GUY',
            'iso2' => 'GY',
            'phonecode' => '592',
            'currency' => 'GYD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 95,
            'name' => 'Haiti',
            'iso3' => 'HTI',
            'iso2' => 'HT',
            'phonecode' => '509',
            'currency' => 'HTG',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 96,
            'name' => 'Heard Island and McDonald Islands',
            'iso3' => 'HMD',
            'iso2' => 'HM',
            'phonecode' => '672',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 97,
            'name' => 'Honduras',
            'iso3' => 'HND',
            'iso2' => 'HN',
            'phonecode' => '504',
            'currency' => 'HNL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 98,
            'name' => 'Hong Kong S.A.R.',
            'iso3' => 'HKG',
            'iso2' => 'HK',
            'phonecode' => '852',
            'currency' => 'HKD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 99,
            'name' => 'Hungary',
            'iso3' => 'HUN',
            'iso2' => 'HU',
            'phonecode' => '36',
            'currency' => 'HUF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 100,
            'name' => 'Iceland',
            'iso3' => 'ISL',
            'iso2' => 'IS',
            'phonecode' => '354',
            'currency' => 'ISK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 101,
            'name' => 'India',
            'iso3' => 'IND',
            'iso2' => 'IN',
            'phonecode' => '91',
            'currency' => 'INR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 102,
            'name' => 'Indonesia',
            'iso3' => 'IDN',
            'iso2' => 'ID',
            'phonecode' => '62',
            'currency' => 'IDR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 103,
            'name' => 'Iran',
            'iso3' => 'IRN',
            'iso2' => 'IR',
            'phonecode' => '98',
            'currency' => 'IRR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 104,
            'name' => 'Iraq',
            'iso3' => 'IRQ',
            'iso2' => 'IQ',
            'phonecode' => '964',
            'currency' => 'IQD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 105,
            'name' => 'Ireland',
            'iso3' => 'IRL',
            'iso2' => 'IE',
            'phonecode' => '353',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 106,
            'name' => 'Israel',
            'iso3' => 'ISR',
            'iso2' => 'IL',
            'phonecode' => '972',
            'currency' => 'ILS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 107,
            'name' => 'Italy',
            'iso3' => 'ITA',
            'iso2' => 'IT',
            'phonecode' => '39',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 108,
            'name' => 'Jamaica',
            'iso3' => 'JAM',
            'iso2' => 'JM',
            'phonecode' => '1-876',
            'currency' => 'JMD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 109,
            'name' => 'Japan',
            'iso3' => 'JPN',
            'iso2' => 'JP',
            'phonecode' => '81',
            'currency' => 'JPY',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 110,
            'name' => 'Jersey',
            'iso3' => 'JEY',
            'iso2' => 'JE',
            'phonecode' => '44-1534',
            'currency' => 'GBP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 111,
            'name' => 'Jordan',
            'iso3' => 'JOR',
            'iso2' => 'JO',
            'phonecode' => '962',
            'currency' => 'JOD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 112,
            'name' => 'Kazakhstan',
            'iso3' => 'KAZ',
            'iso2' => 'KZ',
            'phonecode' => '7',
            'currency' => 'KZT',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 113,
            'name' => 'Kenya',
            'iso3' => 'KEN',
            'iso2' => 'KE',
            'phonecode' => '254',
            'currency' => 'KES',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 114,
            'name' => 'Kiribati',
            'iso3' => 'KIR',
            'iso2' => 'KI',
            'phonecode' => '686',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 115,
            'name' => 'North Korea',
            'iso3' => 'PRK',
            'iso2' => 'KP',
            'phonecode' => '850',
            'currency' => 'KPW',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 116,
            'name' => 'South Korea',
            'iso3' => 'KOR',
            'iso2' => 'KR',
            'phonecode' => '82',
            'currency' => 'KRW',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 117,
            'name' => 'Kuwait',
            'iso3' => 'KWT',
            'iso2' => 'KW',
            'phonecode' => '965',
            'currency' => 'KWD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 118,
            'name' => 'Kyrgyzstan',
            'iso3' => 'KGZ',
            'iso2' => 'KG',
            'phonecode' => '996',
            'currency' => 'KGS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 119,
            'name' => 'Laos',
            'iso3' => 'LAO',
            'iso2' => 'LA',
            'phonecode' => '856',
            'currency' => 'LAK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 120,
            'name' => 'Latvia',
            'iso3' => 'LVA',
            'iso2' => 'LV',
            'phonecode' => '371',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 121,
            'name' => 'Lebanon',
            'iso3' => 'LBN',
            'iso2' => 'LB',
            'phonecode' => '961',
            'currency' => 'LBP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 122,
            'name' => 'Lesotho',
            'iso3' => 'LSO',
            'iso2' => 'LS',
            'phonecode' => '266',
            'currency' => 'LSL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 123,
            'name' => 'Liberia',
            'iso3' => 'LBR',
            'iso2' => 'LR',
            'phonecode' => '231',
            'currency' => 'LRD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 124,
            'name' => 'Libya',
            'iso3' => 'LBY',
            'iso2' => 'LY',
            'phonecode' => '218',
            'currency' => 'LYD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 125,
            'name' => 'Liechtenstein',
            'iso3' => 'LIE',
            'iso2' => 'LI',
            'phonecode' => '423',
            'currency' => 'CHF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 126,
            'name' => 'Lithuania',
            'iso3' => 'LTU',
            'iso2' => 'LT',
            'phonecode' => '370',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 127,
            'name' => 'Luxembourg',
            'iso3' => 'LUX',
            'iso2' => 'LU',
            'phonecode' => '352',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 128,
            'name' => 'Macau S.A.R.',
            'iso3' => 'MAC',
            'iso2' => 'MO',
            'phonecode' => '853',
            'currency' => 'MOP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 129,
            'name' => 'North Macedonia',
            'iso3' => 'MKD',
            'iso2' => 'MK',
            'phonecode' => '389',
            'currency' => 'MKD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 130,
            'name' => 'Madagascar',
            'iso3' => 'MDG',
            'iso2' => 'MG',
            'phonecode' => '261',
            'currency' => 'MGA',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 131,
            'name' => 'Malawi',
            'iso3' => 'MWI',
            'iso2' => 'MW',
            'phonecode' => '265',
            'currency' => 'MWK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 132,
            'name' => 'Malaysia',
            'iso3' => 'MYS',
            'iso2' => 'MY',
            'phonecode' => '60',
            'currency' => 'MYR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 133,
            'name' => 'Maldives',
            'iso3' => 'MDV',
            'iso2' => 'MV',
            'phonecode' => '960',
            'currency' => 'MVR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 134,
            'name' => 'Mali',
            'iso3' => 'MLI',
            'iso2' => 'ML',
            'phonecode' => '223',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 135,
            'name' => 'Malta',
            'iso3' => 'MLT',
            'iso2' => 'MT',
            'phonecode' => '356',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 136,
            'name' => 'Man (Isle of)',
            'iso3' => 'IMN',
            'iso2' => 'IM',
            'phonecode' => '44-1624',
            'currency' => 'GBP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 137,
            'name' => 'Marshall Islands',
            'iso3' => 'MHL',
            'iso2' => 'MH',
            'phonecode' => '692',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 138,
            'name' => 'Martinique',
            'iso3' => 'MTQ',
            'iso2' => 'MQ',
            'phonecode' => '596',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 139,
            'name' => 'Mauritania',
            'iso3' => 'MRT',
            'iso2' => 'MR',
            'phonecode' => '222',
            'currency' => 'MRO',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 140,
            'name' => 'Mauritius',
            'iso3' => 'MUS',
            'iso2' => 'MU',
            'phonecode' => '230',
            'currency' => 'MUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 141,
            'name' => 'Mayotte',
            'iso3' => 'MYT',
            'iso2' => 'YT',
            'phonecode' => '262',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 142,
            'name' => 'Mexico',
            'iso3' => 'MEX',
            'iso2' => 'MX',
            'phonecode' => '52',
            'currency' => 'MXN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 143,
            'name' => 'Micronesia',
            'iso3' => 'FSM',
            'iso2' => 'FM',
            'phonecode' => '691',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 144,
            'name' => 'Moldova',
            'iso3' => 'MDA',
            'iso2' => 'MD',
            'phonecode' => '373',
            'currency' => 'MDL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 145,
            'name' => 'Monaco',
            'iso3' => 'MCO',
            'iso2' => 'MC',
            'phonecode' => '377',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 146,
            'name' => 'Mongolia',
            'iso3' => 'MNG',
            'iso2' => 'MN',
            'phonecode' => '976',
            'currency' => 'MNT',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 147,
            'name' => 'Montenegro',
            'iso3' => 'MNE',
            'iso2' => 'ME',
            'phonecode' => '382',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 148,
            'name' => 'Montserrat',
            'iso3' => 'MSR',
            'iso2' => 'MS',
            'phonecode' => '1-664',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 149,
            'name' => 'Morocco',
            'iso3' => 'MAR',
            'iso2' => 'MA',
            'phonecode' => '212',
            'currency' => 'MAD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 150,
            'name' => 'Mozambique',
            'iso3' => 'MOZ',
            'iso2' => 'MZ',
            'phonecode' => '258',
            'currency' => 'MZN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 151,
            'name' => 'Myanmar',
            'iso3' => 'MMR',
            'iso2' => 'MM',
            'phonecode' => '95',
            'currency' => 'MMK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 152,
            'name' => 'Namibia',
            'iso3' => 'NAM',
            'iso2' => 'NA',
            'phonecode' => '264',
            'currency' => 'NAD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 153,
            'name' => 'Nauru',
            'iso3' => 'NRU',
            'iso2' => 'NR',
            'phonecode' => '674',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 154,
            'name' => 'Nepal',
            'iso3' => 'NPL',
            'iso2' => 'NP',
            'phonecode' => '977',
            'currency' => 'NPR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 155,
            'name' => 'Bonaire, Sint Eustatius and Saba',
            'iso3' => 'BES',
            'iso2' => 'BQ',
            'phonecode' => '599',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-08 21:04:58'
        ]);

        Countries::create([
            'id' => 156,
            'name' => 'Netherlands',
            'iso3' => 'NLD',
            'iso2' => 'NL',
            'phonecode' => '31',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 157,
            'name' => 'New Caledonia',
            'iso3' => 'NCL',
            'iso2' => 'NC',
            'phonecode' => '687',
            'currency' => 'XPF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 158,
            'name' => 'New Zealand',
            'iso3' => 'NZL',
            'iso2' => 'NZ',
            'phonecode' => '64',
            'currency' => 'NZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 159,
            'name' => 'Nicaragua',
            'iso3' => 'NIC',
            'iso2' => 'NI',
            'phonecode' => '505',
            'currency' => 'NIO',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 160,
            'name' => 'Niger',
            'iso3' => 'NER',
            'iso2' => 'NE',
            'phonecode' => '227',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 161,
            'name' => 'Nigeria',
            'iso3' => 'NGA',
            'iso2' => 'NG',
            'phonecode' => '234',
            'currency' => 'NGN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 162,
            'name' => 'Niue',
            'iso3' => 'NIU',
            'iso2' => 'NU',
            'phonecode' => '683',
            'currency' => 'NZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 163,
            'name' => 'Norfolk Island',
            'iso3' => 'NFK',
            'iso2' => 'NF',
            'phonecode' => '672',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 164,
            'name' => 'Northern Mariana Islands',
            'iso3' => 'MNP',
            'iso2' => 'MP',
            'phonecode' => '1-670',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 165,
            'name' => 'Norway',
            'iso3' => 'NOR',
            'iso2' => 'NO',
            'phonecode' => '47',
            'currency' => 'NOK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 166,
            'name' => 'Oman',
            'iso3' => 'OMN',
            'iso2' => 'OM',
            'phonecode' => '968',
            'currency' => 'OMR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 167,
            'name' => 'Pakistan',
            'iso3' => 'PAK',
            'iso2' => 'PK',
            'phonecode' => '92',
            'currency' => 'PKR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 168,
            'name' => 'Palau',
            'iso3' => 'PLW',
            'iso2' => 'PW',
            'phonecode' => '680',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 169,
            'name' => 'Palestinian Territory Occupied',
            'iso3' => 'PSE',
            'iso2' => 'PS',
            'phonecode' => '970',
            'currency' => 'ILS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 170,
            'name' => 'Panama',
            'iso3' => 'PAN',
            'iso2' => 'PA',
            'phonecode' => '507',
            'currency' => 'PAB',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 171,
            'name' => 'Papua new Guinea',
            'iso3' => 'PNG',
            'iso2' => 'PG',
            'phonecode' => '675',
            'currency' => 'PGK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 172,
            'name' => 'Paraguay',
            'iso3' => 'PRY',
            'iso2' => 'PY',
            'phonecode' => '595',
            'currency' => 'PYG',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 173,
            'name' => 'Peru',
            'iso3' => 'PER',
            'iso2' => 'PE',
            'phonecode' => '51',
            'currency' => 'PEN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 174,
            'name' => 'Philippines',
            'iso3' => 'PHL',
            'iso2' => 'PH',
            'phonecode' => '63',
            'currency' => 'PHP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 175,
            'name' => 'Pitcairn Island',
            'iso3' => 'PCN',
            'iso2' => 'PN',
            'phonecode' => '870',
            'currency' => 'NZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 176,
            'name' => 'Poland',
            'iso3' => 'POL',
            'iso2' => 'PL',
            'phonecode' => '48',
            'currency' => 'PLN',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 177,
            'name' => 'Portugal',
            'iso3' => 'PRT',
            'iso2' => 'PT',
            'phonecode' => '351',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 178,
            'name' => 'Puerto Rico',
            'iso3' => 'PRI',
            'iso2' => 'PR',
            'phonecode' => '1-787',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 179,
            'name' => 'Qatar',
            'iso3' => 'QAT',
            'iso2' => 'QA',
            'phonecode' => '974',
            'currency' => 'QAR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 180,
            'name' => 'Reunion',
            'iso3' => 'REU',
            'iso2' => 'RE',
            'phonecode' => '262',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 181,
            'name' => 'Romania',
            'iso3' => 'ROU',
            'iso2' => 'RO',
            'phonecode' => '40',
            'currency' => 'RON',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 182,
            'name' => 'Russia',
            'iso3' => 'RUS',
            'iso2' => 'RU',
            'phonecode' => '7',
            'currency' => 'RUB',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 183,
            'name' => 'Rwanda',
            'iso3' => 'RWA',
            'iso2' => 'RW',
            'phonecode' => '250',
            'currency' => 'RWF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 184,
            'name' => 'Saint Helena',
            'iso3' => 'SHN',
            'iso2' => 'SH',
            'phonecode' => '290',
            'currency' => 'SHP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 185,
            'name' => 'Saint Kitts And Nevis',
            'iso3' => 'KNA',
            'iso2' => 'KN',
            'phonecode' => '1-869',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 186,
            'name' => 'Saint Lucia',
            'iso3' => 'LCA',
            'iso2' => 'LC',
            'phonecode' => '1-758',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 187,
            'name' => 'Saint Pierre and Miquelon',
            'iso3' => 'SPM',
            'iso2' => 'PM',
            'phonecode' => '508',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 188,
            'name' => 'Saint Vincent And The Grenadines',
            'iso3' => 'VCT',
            'iso2' => 'VC',
            'phonecode' => '1-784',
            'currency' => 'XCD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 189,
            'name' => 'Saint-Barthelemy',
            'iso3' => 'BLM',
            'iso2' => 'BL',
            'phonecode' => '590',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 190,
            'name' => 'Saint-Martin (French part)',
            'iso3' => 'MAF',
            'iso2' => 'MF',
            'phonecode' => '590',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 191,
            'name' => 'Samoa',
            'iso3' => 'WSM',
            'iso2' => 'WS',
            'phonecode' => '685',
            'currency' => 'WST',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 192,
            'name' => 'San Marino',
            'iso3' => 'SMR',
            'iso2' => 'SM',
            'phonecode' => '378',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 193,
            'name' => 'Sao Tome and Principe',
            'iso3' => 'STP',
            'iso2' => 'ST',
            'phonecode' => '239',
            'currency' => 'STD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 194,
            'name' => 'Saudi Arabia',
            'iso3' => 'SAU',
            'iso2' => 'SA',
            'phonecode' => '966',
            'currency' => 'SAR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 195,
            'name' => 'Senegal',
            'iso3' => 'SEN',
            'iso2' => 'SN',
            'phonecode' => '221',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 196,
            'name' => 'Serbia',
            'iso3' => 'SRB',
            'iso2' => 'RS',
            'phonecode' => '381',
            'currency' => 'RSD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 197,
            'name' => 'Seychelles',
            'iso3' => 'SYC',
            'iso2' => 'SC',
            'phonecode' => '248',
            'currency' => 'SCR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 198,
            'name' => 'Sierra Leone',
            'iso3' => 'SLE',
            'iso2' => 'SL',
            'phonecode' => '232',
            'currency' => 'SLL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 199,
            'name' => 'Singapore',
            'iso3' => 'SGP',
            'iso2' => 'SG',
            'phonecode' => '65',
            'currency' => 'SGD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 200,
            'name' => 'Slovakia',
            'iso3' => 'SVK',
            'iso2' => 'SK',
            'phonecode' => '421',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 201,
            'name' => 'Slovenia',
            'iso3' => 'SVN',
            'iso2' => 'SI',
            'phonecode' => '386',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 202,
            'name' => 'Solomon Islands',
            'iso3' => 'SLB',
            'iso2' => 'SB',
            'phonecode' => '677',
            'currency' => 'SBD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 203,
            'name' => 'Somalia',
            'iso3' => 'SOM',
            'iso2' => 'SO',
            'phonecode' => '252',
            'currency' => 'SOS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 204,
            'name' => 'South Africa',
            'iso3' => 'ZAF',
            'iso2' => 'ZA',
            'phonecode' => '27',
            'currency' => 'ZAR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 205,
            'name' => 'South Georgia',
            'iso3' => 'SGS',
            'iso2' => 'GS',
            'phonecode' => '500',
            'currency' => 'GBP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 206,
            'name' => 'South Sudan',
            'iso3' => 'SSD',
            'iso2' => 'SS',
            'phonecode' => '211',
            'currency' => 'SSP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 207,
            'name' => 'Spain',
            'iso3' => 'ESP',
            'iso2' => 'ES',
            'phonecode' => '34',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 208,
            'name' => 'Sri Lanka',
            'iso3' => 'LKA',
            'iso2' => 'LK',
            'phonecode' => '94',
            'currency' => 'LKR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 209,
            'name' => 'Sudan',
            'iso3' => 'SDN',
            'iso2' => 'SD',
            'phonecode' => '249',
            'currency' => 'SDG',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 210,
            'name' => 'Suriname',
            'iso3' => 'SUR',
            'iso2' => 'SR',
            'phonecode' => '597',
            'currency' => 'SRD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 211,
            'name' => 'Svalbard And Jan Mayen Islands',
            'iso3' => 'SJM',
            'iso2' => 'SJ',
            'phonecode' => '47',
            'currency' => 'NOK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 212,
            'name' => 'Swaziland',
            'iso3' => 'SWZ',
            'iso2' => 'SZ',
            'phonecode' => '268',
            'currency' => 'SZL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 213,
            'name' => 'Sweden',
            'iso3' => 'SWE',
            'iso2' => 'SE',
            'phonecode' => '46',
            'currency' => 'SEK',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 214,
            'name' => 'Switzerland',
            'iso3' => 'CHE',
            'iso2' => 'CH',
            'phonecode' => '41',
            'currency' => 'CHF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 215,
            'name' => 'Syria',
            'iso3' => 'SYR',
            'iso2' => 'SY',
            'phonecode' => '963',
            'currency' => 'SYP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 216,
            'name' => 'Taiwan',
            'iso3' => 'TWN',
            'iso2' => 'TW',
            'phonecode' => '886',
            'currency' => 'TWD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 217,
            'name' => 'Tajikistan',
            'iso3' => 'TJK',
            'iso2' => 'TJ',
            'phonecode' => '992',
            'currency' => 'TJS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 218,
            'name' => 'Tanzania',
            'iso3' => 'TZA',
            'iso2' => 'TZ',
            'phonecode' => '255',
            'currency' => 'TZS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 219,
            'name' => 'Thailand',
            'iso3' => 'THA',
            'iso2' => 'TH',
            'phonecode' => '66',
            'currency' => 'THB',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 220,
            'name' => 'Togo',
            'iso3' => 'TGO',
            'iso2' => 'TG',
            'phonecode' => '228',
            'currency' => 'XOF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 221,
            'name' => 'Tokelau',
            'iso3' => 'TKL',
            'iso2' => 'TK',
            'phonecode' => '690',
            'currency' => 'NZD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 222,
            'name' => 'Tonga',
            'iso3' => 'TON',
            'iso2' => 'TO',
            'phonecode' => '676',
            'currency' => 'TOP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 223,
            'name' => 'Trinidad And Tobago',
            'iso3' => 'TTO',
            'iso2' => 'TT',
            'phonecode' => '1-868',
            'currency' => 'TTD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 224,
            'name' => 'Tunisia',
            'iso3' => 'TUN',
            'iso2' => 'TN',
            'phonecode' => '216',
            'currency' => 'TND',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 225,
            'name' => 'Turkey',
            'iso3' => 'TUR',
            'iso2' => 'TR',
            'phonecode' => '90',
            'currency' => 'TRY',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 226,
            'name' => 'Turkmenistan',
            'iso3' => 'TKM',
            'iso2' => 'TM',
            'phonecode' => '993',
            'currency' => 'TMT',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 227,
            'name' => 'Turks And Caicos Islands',
            'iso3' => 'TCA',
            'iso2' => 'TC',
            'phonecode' => '1-649',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 228,
            'name' => 'Tuvalu',
            'iso3' => 'TUV',
            'iso2' => 'TV',
            'phonecode' => '688',
            'currency' => 'AUD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 229,
            'name' => 'Uganda',
            'iso3' => 'UGA',
            'iso2' => 'UG',
            'phonecode' => '256',
            'currency' => 'UGX',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 230,
            'name' => 'Ukraine',
            'iso3' => 'UKR',
            'iso2' => 'UA',
            'phonecode' => '380',
            'currency' => 'UAH',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 231,
            'name' => 'United Arab Emirates',
            'iso3' => 'ARE',
            'iso2' => 'AE',
            'phonecode' => '971',
            'currency' => 'AED',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 232,
            'name' => 'United Kingdom',
            'iso3' => 'GBR',
            'iso2' => 'GB',
            'phonecode' => '44',
            'currency' => 'GBP',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 233,
            'name' => 'United States',
            'iso3' => 'USA',
            'iso2' => 'US',
            'phonecode' => '1',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 234,
            'name' => 'United States Minor Outlying Islands',
            'iso3' => 'UMI',
            'iso2' => 'UM',
            'phonecode' => '1',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 235,
            'name' => 'Uruguay',
            'iso3' => 'URY',
            'iso2' => 'UY',
            'phonecode' => '598',
            'currency' => 'UYU',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 236,
            'name' => 'Uzbekistan',
            'iso3' => 'UZB',
            'iso2' => 'UZ',
            'phonecode' => '998',
            'currency' => 'UZS',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 237,
            'name' => 'Vanuatu',
            'iso3' => 'VUT',
            'iso2' => 'VU',
            'phonecode' => '678',
            'currency' => 'VUV',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 238,
            'name' => 'Vatican City State (Holy See)',
            'iso3' => 'VAT',
            'iso2' => 'VA',
            'phonecode' => '379',
            'currency' => 'EUR',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 239,
            'name' => 'Venezuela',
            'iso3' => 'VEN',
            'iso2' => 'VE',
            'phonecode' => '58',
            'currency' => 'VES',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 240,
            'name' => 'Vietnam',
            'iso3' => 'VNM',
            'iso2' => 'VN',
            'phonecode' => '84',
            'currency' => 'VND',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 241,
            'name' => 'Virgin Islands (British)',
            'iso3' => 'VGB',
            'iso2' => 'VG',
            'phonecode' => '1-284',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 242,
            'name' => 'Virgin Islands (US)',
            'iso3' => 'VIR',
            'iso2' => 'VI',
            'phonecode' => '1-340',
            'currency' => 'USD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 243,
            'name' => 'Wallis And Futuna Islands',
            'iso3' => 'WLF',
            'iso2' => 'WF',
            'phonecode' => '681',
            'currency' => 'XPF',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 244,
            'name' => 'Western Sahara',
            'iso3' => 'ESH',
            'iso2' => 'EH',
            'phonecode' => '212',
            'currency' => 'MAD',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 245,
            'name' => 'Yemen',
            'iso3' => 'YEM',
            'iso2' => 'YE',
            'phonecode' => '967',
            'currency' => 'YER',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 246,
            'name' => 'Zambia',
            'iso3' => 'ZMB',
            'iso2' => 'ZM',
            'phonecode' => '260',
            'currency' => 'ZMW',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 247,
            'name' => 'Zimbabwe',
            'iso3' => 'ZWE',
            'iso2' => 'ZW',
            'phonecode' => '263',
            'currency' => 'ZWL',
            'created_at' => '2018-07-21 07:11:03',
            'updated_at' => '2023-08-09 19:23:19'
        ]);

        Countries::create([
            'id' => 248,
            'name' => 'Kosovo',
            'iso3' => 'XKX',
            'iso2' => 'XK',
            'phonecode' => '383',
            'currency' => 'EUR',
            'created_at' => '2020-08-16 02:33:50',
            'updated_at' => '2023-08-11 15:46:28'
        ]);

        Countries::create([
            'id' => 249,
            'name' => 'Curaçao',
            'iso3' => 'CUW',
            'iso2' => 'CW',
            'phonecode' => '599',
            'currency' => 'ANG',
            'created_at' => '2020-10-26 01:54:20',
            'updated_at' => '2023-08-11 15:45:55'
        ]);

        Countries::create([
            'id' => 250,
            'name' => 'Sint Maarten (Dutch part)',
            'iso3' => 'SXM',
            'iso2' => 'SX',
            'phonecode' => '1721',
            'currency' => 'ANG',
            'created_at' => '2020-12-06 00:03:39',
            'updated_at' => '2023-08-09 19:23:19'
        ]);
    }
}
