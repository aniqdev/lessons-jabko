<?php

if (is_page('login') && !empty($_POST['name'])) {
    session_set('name', $_POST['name']);
    session_set('email', $_POST['email']);
    session_set('phone', $_POST['phone']);

    flash_set('success', 'Profile updated successfully!');

    redirect_to('/?page=login');
}



if (is_page('product') && !empty($_POST['add-product-review'])) {

    
    redirect_to('/?page=product&product-id=10');
}
