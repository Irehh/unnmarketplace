<?php

//dont delete as it is in use in all pages for user folder to display user info

//select data from database
  $change = "SELECT * FROM users WHERE id=$user_id limit 1 ";
  $oldresult=mysqli_query($conn,$change);
  $rowu=mysqli_fetch_assoc($oldresult);
  $userdate = safe($rowu['date']);
  $userimage = safe($rowu['image']);
  $username = safe($rowu["name"]);
  $userabout = safe($rowu['about']);
  $userpage = safe($rowu['page_views_count']);