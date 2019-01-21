<?php namespace Lovata\OrdersShopaholic\Models;

use Model;

use Kharanenka\Scope\UserBelongsTo;
use Lovata\Toolbox\Classes\Helper\UserHelper;

/**
 * Class Cart
 * @package Lovata\OrdersShopaholic\Models
 * @author  Andrey Kharanenka, a.khoronenko@lovata.com, LOVATA Group
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property                                                 $id
 * @property integer                                         $user_id
 * @property \October\Rain\Argon\Argon                       $created_at
 * @property \October\Rain\Argon\Argon                       $updated_at
 *
 * @property \Lovata\Buddies\Models\User                     $user
 * @method static \Lovata\Buddies\Models\User|\October\Rain\Database\Relations\BelongsTo user()
 * @property \October\Rain\Database\Collection|CartPosition[] $position
 * @method static CartPosition|\October\Rain\Database\Relations\HasMany position()
 *
 * Coupons for Shopaholic
 * @property \October\Rain\Database\Collection|\Lovata\CouponsShopaholic\Models\Coupon[] $coupon
 * @method static \October\Rain\Database\Relations\BelongsToMany|\Lovata\CouponsShopaholic\Models\Coupon coupon()
 */
class Cart extends Model
{
    use UserBelongsTo;

    public $table = 'lovata_orders_shopaholic_carts';

    protected $fillable = [
        'user_id',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public $belongsTo = [];
    public $hasMany = ['position' => CartPosition::class];
    public $belongsToMany = [];

    /**
     * Cart constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $sUserModelClass = UserHelper::instance()->getUserModel();
        if (!empty($sUserModelClass)) {
            $this->belongsTo['user'] = [$sUserModelClass];
        }

        parent::__construct($attributes);
    }
}
