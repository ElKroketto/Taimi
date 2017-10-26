<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 10:49
 */
?>

<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <span class="navbar-brand mb-0 h1" title="TAIMI - samoanisch für Zeit"><i class="fa fa-clock-o"></i> TAIMI</span>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= (($layoutViewName == 'projects' || $layoutViewName == 'editProject' || $layoutViewName == 'projectDetails') ? 'active' : '') ?>">
                    <a class="nav-link" href="?view=projects">Projects</a>
                </li>
                <li class="nav-item <?= (($layoutViewName == 'clients' || $layoutViewName == 'editClient') ? 'active' : '') ?>">
                    <a class="nav-link" href="?view=clients">Clients</a>
                </li>
                <li class="nav-item <?= (($layoutViewName == 'about') ? 'active' : '') ?>">
                    <a class="nav-link" href="?view=about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?view=logout">Sign out</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
