<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));    
});

// Home > About
Breadcrumbs::for('aboutus', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us');
});

// Home > Sample Packs
Breadcrumbs::for('samplepacks', function ($trail) {
    $trail->parent('home');
    $trail->push('Sample Packs');
});

// Home > Request a Quote
Breadcrumbs::for('request_quote', function ($trail) {
    $trail->parent('home');
    $trail->push('Request a Quote');
});
// Home > Request a FAQ
Breadcrumbs::for('faq', function ($trail) {
    $trail->parent('home');
    $trail->push('FAQ');
});
// Home > Request a contact
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push('Contact');
});
// Home > Request a registeration
Breadcrumbs::for('registeration', function ($trail) {
    $trail->parent('home');
    $trail->push('Customer Registration');
});
// Home > Request a reset_pasword
Breadcrumbs::for('reset_pasword', function ($trail) {
    $trail->parent('home');
    $trail->push('Reset Password');
});
// Home > Request a change_pasword
Breadcrumbs::for('change_pasword', function ($trail) {
    $trail->parent('home');
    $trail->push('Change Password');
});
// Home > Request a legal
Breadcrumbs::for('legal', function ($trail) {
    $trail->parent('home');
    $trail->push('Legal');
});
// Home > Request a  Artwork Guide
Breadcrumbs::for('artwork-guide', function ($trail) {
    $trail->parent('home');
    $trail->push(' Artwork Guide');
});
// Home > Request a  Upload Artwork
Breadcrumbs::for('upload-artwork', function ($trail) {
    $trail->parent('home');
    $trail->push('Upload Artwork');
});

// Home > Cutting Forme
Breadcrumbs::for('cutting-forme', function ($trail) {
    $trail->parent('home');
    $trail->push('Cutting Forme');
});

// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > My-account
Breadcrumbs::for('my-account', function ($trail) {
    $trail->parent('home');
    $trail->push('My Account');
});
// Home > My-Jobs
Breadcrumbs::for('my-jobs', function ($trail) {
    $trail->parent('home');
    $trail->push('Jobs Status');
});
// Home > My-Invoice
Breadcrumbs::for('my-invoice', function ($trail) {
    $trail->parent('home');
    $trail->push('Invoices');
});
// Home > My-quote
Breadcrumbs::for('my-quote', function ($trail) {
    $trail->parent('home');
    $trail->push('Quotes');
});

//Home > Blog > [Category]
Breadcrumbs::register('category', function ($trail, $category) {   
    $trail->parent('home');
    $trail->push('All Products',url('products', ""));    
    $trail->push($category->name, route('category', $category->id));
});

//Home > Blog > [Category]
Breadcrumbs::register('products', function ($trail, $products) { 
    $trail->parent('home');
    $trail->push('All Products',url('products'));    
});

Breadcrumbs::for('product.view', function ($trail, $product) {    
    $trail->parent('home'); 
    $trail->push('All Products',url('products', ""));   
    $parentCat = DB::table('category_product')
                    ->where("product_id",$product->id)
                    ->first();
    $categorydata = DB::table('categories')
                              ->where("id",$parentCat->category_id)
                              ->first();                               
    $trail->push($categorydata->name, route('category', $categorydata->slug));
    $trail->push($product->name, route('product.view', $product->id));
});

// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('home');

//     foreach ($category->id as $ancestor) {
//         $trail->push($ancestor->name, route('category', $ancestor->parent_id));
//     }

//     $trail->push($category->name, route('category', $category->parent_id));
// });

// Home > Blog > [Category] > [Post]
Breadcrumbs::for('post', function ($trail, $post) {
    $trail->parent('category', $post->category);
    $trail->push($post->title, route('post', $post->id));
});