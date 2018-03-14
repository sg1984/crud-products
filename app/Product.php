<?php namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'name', 'description', 'quantity', 'price',
        'created_by', 'created_at', 'updated_at', 'deleted_at', 'deleted_by',
    ];

    protected $mandatoryFields = [
        'name', 'description'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function validateAndNew(array $productInfo = [])
    {
        $product = self::validateAndNewInstance(new self(), $productInfo);
        $product->save();
        return $product;
    }

    public static function validateAndUpdate(Product $product, $request)
    {
        $requestFields = $request->only($product->mandatoryFields);
        self::validateDataForNewInstance($product, $requestFields);
        $product->update([
            'name' => array_get($requestFields, 'name'),
            'description' => array_get($requestFields, 'description'),
            'quantity' => array_get($requestFields, 'quantity'),
            'price' => array_get($requestFields, 'price'),
        ]);
        return $product;
    }

    public function getName()
    {
        if( empty($this->name) ){
            return '---';
        }

        return $this->name;
    }

    public function getQuantity()
    {
        if( empty($this->quantity) ){
            return 0;
        }

        return $this->quantity;
    }

    public function getDescription()
    {
        if( empty($this->description) ){
            return '---';
        }

        return $this->description;
    }

    public function getPrice()
    {
        if( empty($this->price) ){
            return 0.00;
        }

        return number_format((float)$this->price, 2, '.', '');
    }

    public function getTotal()
    {
        if( empty($this->price) ){
            return 0.00;
        }

        return number_format((float)($this->price * $this->quantity ), 2, '.', '');
    }

    public function getCreator()
    {
        if( empty($this->creator) ){
            return '---';
        }

        return $this->creator->name;
    }
}
