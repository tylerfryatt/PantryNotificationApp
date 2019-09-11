<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/17/2019
 * Time: 8:12 PM
 */

 header('Content-type: text/css');


 ?>

.navtop {
    background-color: #0275d8;
    height: 60px;
    width: 100%;
    border: 0;
}
.navtop div {
    display: flex;
    margin: 0 auto;
    width: 1000px;
    height: 100%;
}
.navtop div h1, .navtop div a {
    display: inline-flex;
    align-items: center;
}
.navtop div h1 {
    flex: 1;
    font-size: 24px;
    padding: 0;
    margin: 0;
    color: white;
    font-weight: normal;
}
.navtop div a {
    padding: 0 20px;
    text-decoration: none;
    color: white;
    font-weight: bold;
}
.navtop div a i {
    padding: 2px 8px 0 0;
}
.navtop div a:hover {
    color: lightgrey;
}
body.loggedin {
    background-color: white;
}
.hide {
    display:none;
}

#changePasswordButton {
float:right;
}
.content {
    width: 1000px;
    margin: 0 auto;
}
.content h2 {
    margin: 0;
    padding: 25px 0;
    font-size: 22px;
    border-bottom: 1px solid #e0e0e3;
    color: #4a536e;
}
.content > p, .content > div {
    box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
    margin: 25px 0;
    padding: 25px;
    background-color: #fff;
}
.content > p table td, .content > div table td {
    padding: 5px;
}
.content > p table td:first-child, .content > div table td:first-child {
    font-weight: bold;
    color: #4a536e;
    padding-right: 15px;
}
.content > div p {
    padding: 5px;
    margin: 0 0 10px 0;
}