<?php
$histoireURL = recuphistoire($_GET['histoireId']);
$histoireURL = $histoireURL->fetchAll();
