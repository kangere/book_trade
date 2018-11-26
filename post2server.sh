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

echo "files copied successfully"