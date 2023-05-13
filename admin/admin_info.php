<?php

//dont delete as it is in use in all pages for user folder to display user info

//select data from database
  $change = "SELECT * FROM users WHERE id='$admin_id' limit 1 ";
  $oldresult=mysqli_query($conn,$change);
  $rowu=mysqli_fetch_assoc($oldresult);
  $admindate = safe($rowu['date']);
  $adminimage = safe($rowu['image']);
  $adminname = safe($rowu["name"]);