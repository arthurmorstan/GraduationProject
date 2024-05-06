<?php
require 'config/constants.php';

// destroy all sesson and get back to home page
session_destroy();
header('location: ' . ROOT_URL);
die();