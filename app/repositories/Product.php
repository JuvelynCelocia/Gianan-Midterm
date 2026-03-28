<?php
  use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
protected $fillable = [
   'name',
   'sku',
   'description',
   'category',
   'price',
   'cost_price',
   'stock',
   'min_stock_level',
   'supplier_name',
   'supplier_contact',
];
}
