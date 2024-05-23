<?php

$iniUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

?>

<div class="sidebar" data-color="red">

    <div class="logo">
        {{-- <a href="/" class="simple-text logo-mini">
            CT
        </a> --}}
        <a href="/" class="simple-text logo-normal">
            Belajar Bahasa Jepang
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
            <li class="@if ($iniUrl == 'http://' . $_SERVER['HTTP_HOST'] . '/') active @endif">
                <a href="/">
                    <i class="now-ui-icons design_app"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="@if ($iniUrl == 'http://'.$_SERVER['HTTP_HOST'].'/ujian') active @endif">
                <a href="/ujian">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>Ujian</p>
                </a>
            </li>

            {{-- <li class="active-pro">
                <a href="./upgrade.html">
                    <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>
