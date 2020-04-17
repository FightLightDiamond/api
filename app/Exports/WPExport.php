<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class WPExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $columns = [
//            'Type' => 'simple, downloadable, virtual',
//            'SKU' => 'WOO-SINGLE',
//            'Name' => 'Woo Singles',
            'Published' => 1,
            'Is featured?' => 0,
            'Visibility in catalog' => 'visible',
            'Short description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'Description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'Date sale price starts' => '',
            'Date sale price ends' => '',
            'Tax class' => 'taxable',
            'In stock?' => 1,
            'Stock' => 10,
            'Backorders allowed?' => 0,
            'Sold individually?' => 0,
            'Weight (kg)' => 9,
            'Length (cm)'=> 9,
            'Width (cm)'=> 9,
            'Height (cm)' => 9,
            'Allow customer reviews?' => 1,
            'Purchase note' => '',
            'Sale price' => 99,
            'Regular price' => 778,
            'Categories' => 'Music, Music > Singles',
            'Tags' => '',
            'Shipping class' => '',
            'Images' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_6_angle.jpg, http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/cd_6_flat.jpg',
            'Download limit' => 10,
            'Download expiry days' => 90,
            'Parent' => '',
            'Grouped products' => '',
            'Upsells' => '',
            'Cross-sells' => '',
            'External URL' => '',
            'Button text' => 'Song #2',
            'Download 1 URL' => 'https://woocommerce.files.wordpress.com/2017/06/woo-single-2.ogg',
            'Attribute 1 name' => 'Color',
            'Attribute 1 value(s)' => 'Black, Blue',
            'Attribute 1 visible' => 0,
            'Attribute 1 global' => 1,
            'Attribute 2 name' => "Size",
            'Attribute 2 value(s)' => 'L, XL',
            'Attribute 2 visible' => 1,
            'Attribute 2 global' => 0,
            'Attribute 1 default' => 'Black',
            'Attribute 2 default' => 'L',
        ];

        $data = [];
        $data[0][]= 'Type';
        $data[0][]= 'SKU';
        $data[0][]= 'Name';
        foreach ($columns as $key => $column) {
            $data[0][]= $key;
        }
        for ($i = 1; $i < 9999; $i++) {
            $data[$i][]= 'simple, downloadable, virtual';
            $data[$i][]= time(). ' WOO-SINGLE ' . $i ;
            $data[$i][]= time(). ' Woo Singles ' . $i ;
            foreach ($columns as $key => $column) {
                $data[$i][]= $column;
            }
        }

        return $data;
    }
}
