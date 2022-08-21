<?php
$Profile_Status = PROFILE_STATUS;
?>
<Style>
    .ps__rail-y {
    display: none;
}
</Style>
<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu">
                <a  href="home.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="home.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            
            <li class="menu">
                <a  href="manage_category.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_category.php" or $currentFile=="add_category.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>Categories</span>
                    </div>
                </a>
            </li>
            
            
            <li class="menu">
                <a  href="manage_artist.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_artist.php" or $currentFile=="add_artist.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>Artist</span>
                    </div>
                </a>
            </li>
            
            <li class="menu">
                <a  href="manage_album.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_album.php" or $currentFile=="add_album.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>Album</span>
                    </div>
                </a>
            </li>
            
            <li class="menu">
                <a  href="manage_mp3.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_mp3.php" or $currentFile=="add_mp3.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>MP3 Songs</span>
                    </div>
                </a>
            </li>
            
            <li class="menu">
                <a  href="manage_playlist.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_playlist.php" or $currentFile=="add_playlist.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                        <span>Playlist</span>
                    </div>
                </a>
            </li>
            
            
            <li class="menu">
                <a  href="manage_banners.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_banners.php" or $currentFile=="add_banner.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                        <span>Home Banner</span>
                    </div>
                </a>
            </li>
            
            <li class="menu">
                <a  href="manage_news.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_news.php" or $currentFile=="add_news.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        <span>News</span>
                    </div>
                </a>
            </li>

            
            <li class="menu">
                <a  href="manage_movie.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_movie.php" or $currentFile=="add_movie.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-film"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect><line x1="7" y1="2" x2="7" y2="22"></line><line x1="17" y1="2" x2="17" y2="22"></line><line x1="2" y1="12" x2="22" y2="12"></line><line x1="2" y1="7" x2="7" y2="7"></line><line x1="2" y1="17" x2="7" y2="17"></line><line x1="17" y1="17" x2="22" y2="17"></line><line x1="17" y1="7" x2="22" y2="7"></line></svg>
                        <span>Movie Promote</span>
                    </div>
                </a>
            </li>
            
            

            <li class="menu">
                <a  href="send_notification.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="send_notification.php"){?>data-active="true"<?php }?>>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <span>Notification</span>
                    </div>
                </a>
            </li>
            
            
            
            <?php if($Profile_Status != "0"){?>
            
                <li class="menu">
                    <a  href="manage_suggestion.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_suggestion.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                            <span>Suggestion</span>
                        </div>
                    </a>
                </li>
            
 
                <li class="menu">
                    <a  href="manage_report.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_report.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-meh"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="15" x2="16" y2="15"></line><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                            <span>Reports</span>
                        </div>
                    </a>
                </li>
 
                <li class="menu">
                    <a  href="manage_users.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php" or $currentFile=="user_profile.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span>Users</span>
                        </div>
                    </a>
                </li>
            
                <li class="menu">
                    <a  href="app_update.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="app_update.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                            <span>App Update</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu">
                    <a  href="smtp_settings.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="smtp_settings.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span>SMTP Settings</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu">
                    <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"  <?php if($currentFile=="settings.php" or $currentFile=="web_settings.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            <span>Settings</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul id="settings" data-parent="#accordionExample" <?php if($currentFile=="web_settings.php" or $currentFile=="settings.php"){?>class="collapse submenu list-unstyled show"<?php }?>
                    <?php if($currentFile!="web_settings.php" or $currentFile!="settings.php"){?>class="collapse submenu list-unstyled"<?php }?>>
                        <li  <?php if($currentFile=="web_settings.php"){?>class="active"<?php }?> >
                            <a href="web_settings.php">Web Settings </a>
                        </li>
                        <li <?php if($currentFile=="settings.php"){?>class="active"<?php }?>>
                            <a href="settings.php">App Settings</a>
                        </li>
                    </ul>
                </li>
            
                
                <li class="menu">
                    <a  href="verification.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="verification.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                            <span>Verify Purchase</span>
                        </div>
                    </a>
                </li>
                
                <li class="menu">
                    <a  href="manage_admin.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="manage_admin.php" or $currentFile=="admin_user.php"){?>data-active="true"<?php }?>>
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span>Admin</span>
                        </div>
                    </a>
                </li>
                
                <?php if(file_exists('speed_api.php')){?>
                    <li class="menu">
                        <a  href="api_urls.php" aria-expanded="false" class="dropdown-toggle" <?php if($currentFile=="api_urls.php"){?>data-active="true"<?php }?>>
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                <span>API URLS</span>
                            </div>
                        </a>
                    </li>
                <?php }?>
               
            <?php }?>

            </br>
            </br>
            
        </ul>
        
    </nav>

</div>
<!--  END SIDEBAR  -->