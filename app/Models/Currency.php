<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * Class Currency
 *
 * @version August 26, 2021, 6:57 am UTC
 *
 * @property string $currency_name
 * @property string $currency_icon
 * @property string $currency_code
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\CurrencyFactory factory(...$parameters)
 * @method static Builder|Currency newModelQuery()
 * @method static Builder|Currency newQuery()
 * @method static Builder|Currency query()
 * @method static Builder|Currency whereCreatedAt($value)
 * @method static Builder|Currency whereCurrencyCode($value)
 * @method static Builder|Currency whereCurrencyIcon($value)
 * @method static Builder|Currency whereCurrencyName($value)
 * @method static Builder|Currency whereId($value)
 * @method static Builder|Currency whereUpdatedAt($value)
 *
 * @mixin Model
 */
class Currency extends Model
{
    use HasFactory;

    public $table = 'currencies';

    public $fillable = [
        'currency_name',
        'currency_icon',
        'currency_code',
    ];

    const CURRENCY_ARRAY = [
        'ARS' => 'Argentine Peso',
        'AMD' => 'Armenian Dram',
        'AWG' => 'Aruban Guilder',
        'AUD' => 'Australian Dollar',
        'BSD' => 'Bahamian Dollar',
        'BHD' => 'Bahraini Dinar',
        'BDT' => 'Bangladesh, Taka',
        'BZD' => 'Belize Dollar',
        'BMD' => 'Bermudian Dollar',
        'BOB' => 'Bolivia, Boliviano',
        'BAM' => 'Bosnia and Herzegovina convertible mark',
        'BWP' => 'Botswana, Pula',
        'BRL' => 'Brazilian Real',
        'BND' => 'Brunei Dollar',
        'CAD' => 'Canadian Dollar',
        'KYD' => 'Cayman Islands Dollar',
        'CLP' => 'Chilean Peso',
        'CNY' => 'China Yuan Renminbi',
        'COP' => 'Colombian Peso',
        'CRC' => 'Costa Rican Colon',
        'HRK' => 'Croatian Kuna',
        'CUC' => 'Cuban Convertible Peso',
        'CUP' => 'Cuban Peso',
        'CYP' => 'Cyprus Pound',
        'CZK' => 'Czech Koruna',
        'DKK' => 'Danish Krone',
        'DOP' => 'Dominican Peso',
        'XCD' => 'East Caribbean Dollar',
        'EGP' => 'Egyptian Pound',
        'SVC' => 'El Salvador Colon',
        'EUR' => 'Euro',
        'GHC' => 'Ghana, Cedi',
        'GIP' => 'Gibraltar Pound',
        'GTQ' => 'Guatemala, Quetzal',
        'HNL' => 'Honduras, Lempira',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungary, Forint',
        'ISK' => 'Iceland Krona',
        'INR' => 'Indian Rupee ₹',
        'IDR' => 'Indonesia, Rupiah',
        'IRR' => 'Iranian Rial',
        'JMD' => 'Jamaican Dollar',
        'JPY' => 'Japan, Yen',
        'JOD' => 'Jordanian Dinar',
        'KES' => 'Kenyan Shilling',
        'KWD' => 'Kuwaiti Dinar',
        'LVL' => 'Latvian Lats',
        'LBP' => 'Lebanese Pound',
        'LTL' => 'Lithuanian Litas',
        'MKD' => 'Macedonia, Denar',
        'MYR' => 'Malaysian Ringgit',
        'MTL' => 'Maltese Lira',
        'MUR' => 'Mauritius Rupee',
        'MXN' => 'Mexican Peso',
        'MZM' => 'Mozambique Metical',
        'NPR' => 'Nepalese Rupee',
        'ANG' => 'Netherlands Antillian Guilder',
        'ILS' => 'New Israeli Shekel ₪',
        'TRY' => 'New Turkish Lira',
        'NZD' => 'New Zealand Dollar',
        'NOK' => 'Norwegian Krone',
        'PKR' => 'Pakistan Rupee',
        'PEN' => 'Peru, Nuevo Sol',
        'UYU' => 'Peso Uruguayo',
        'PHP' => 'Philippine Peso',
        'PLN' => 'Poland, Zloty',
        'GBP' => 'Pound Sterling',
        'OMR' => 'Rial Omani',
        'RON' => 'Romania, New Leu',
        'ROL' => 'Romania, Old Leu',
        'RUB' => 'Russian Ruble',
        'SAR' => 'Saudi Riyal',
        'SGD' => 'Singapore Dollar',
        'SKK' => 'Slovak Koruna',
        'SIT' => 'Slovenia, Tolar',
        'ZAR' => 'South Africa, Rand',
        'KRW' => 'South Korea, Won ₩',
        'SZL' => 'Swaziland, Lilangeni',
        'SEK' => 'Swedish Krona',
        'CHF' => 'Swiss Franc',
        'TZS' => 'Tanzanian Shilling',
        'THB' => 'Thailand, Baht ฿',
        'TOP' => 'Tonga, Paanga',
        'AED' => 'UAE Dirham',
        'UAH' => 'Ukraine, Hryvnia',
        'USD' => 'US Dollar',
        'VUV' => 'Vanuatu, Vatu',
        'VEF' => 'Venezuela Bolivares Fuertes',
        'VEB' => 'Venezuela, Bolivar',
        'VND' => 'Viet Nam, Dong ₫',
        'ZWD' => 'Zimbabwe Dollar',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'currency_name' => 'string',
        'currency_icon' => 'string',
        'currency_code' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'currency_name' => 'required|unique:currencies',
        'currency_icon' => 'required',
        'currency_code' => 'required|unique:currencies|min:3|max:3',
    ];
}
