#!/bin/bash

echo "copying files apache server"

dest="/var/www/html/"

sudo cp -r include/ $dest
sudo cp home.php $dest
sudo cp login.php $dest
sudo cp registration.php $dest
sudo cp Store.php $dest
sudo cp update.php $dest
sudo cp main.js $dest
sudo cp details.php $dest
sudo cp requests.php $dest
sudo cp request_book.php $dest
sudo cp trades.php $dest
sudo cp changepassword.php $dest
sudo cp search-form.php $dest
sudo cp editProfile.php $dest
sudo cp mailTest.php $dest
sudo cp help_doc.html $dest
sudo cp img1.png $dest
sudo cp img10.png $dest
sudo cp img2.png $dest
sudo cp img6.png $dest
sudo cp img7.png $dest
sudo cp img8.png $dest


echo "files copied successfully"