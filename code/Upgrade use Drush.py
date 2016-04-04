o upgrade from a previous major version of Drupal to Drupal 7.x, after
following the instructions in the INTRODUCTION section at the top of this file:

1. Check on the Drupal 7 status of your contributed and custom modules and
   themes. See http://drupal.org/node/948216 for information on upgrading
   contributed modules and themes. See http://drupal.org/node/895314 for a list
   of modules that have been moved into core for Drupal 7, and instructions on
   how to update them. See http://drupal.org/update/modules for information on
   how to update your custom modules, and http://drupal.org/update/theme for
   custom themes.

   You may decide at this point that you cannot upgrade your site, because
   needed modules or themes are not ready for Drupal 7.

2. Update to the latest available version of Drupal 6.x (if your current version
   is Drupal 5.x, you have to upgrade to 6.x first). If you need to update,
   download Drupal 6.x and follow the instructions in its UPGRADE.txt. This
   document only applies for upgrades from 6.x to 7.x.

3. In addition to updating to the latest available version of Drupal 6.x core,
   you must also upgrade all of your contributed modules for Drupal to their
   latest Drupal 6.x versions.

4. Log in as user ID 1 (the site maintenance user).

5. Go to Administer > Site configuration > Site maintenance. Select
   "Off-line" and save the configuration.

6. Go to Administer > Site building > Themes. Enable "Garland" and select it as
   the default theme.

7. Go to Administer > Site building > Modules. Disable all modules that are not
   listed under "Core - required" or "Core - optional". It is possible that some
   modules cannot be disabled, because others depend on them. Repeat this step
   until all non-core modules are disabled.

   If you know that you will not re-enable some modules for Drupal 7.x and you
   no longer need their data, then you can uninstall them under the Uninstall
   tab after disabling them.

8. On the command line or in your FTP client, remove the file

     sites/default/default.settings.php

9. Remove all old core files and directories, except for the 'sites' directory
   and any custom files you added elsewhere.

   If you made modifications to files like .htaccess or robots.txt, you will
   need to re-apply them from your backup, after the new files are in place.

10. If you uninstalled any modules, remove them from the sites/all/modules and
   other sites/*/modules directories. Leave other modules in place, even though
   they are incompatible with Drupal 7.x.

11. Download the latest Drupal 7.x release from http://drupal.org to a
   directory outside of your web root. Extract the archive and copy the files
   into your Drupal directory.

   On a typical Unix/Linux command line, use the following commands to download
   and extract:

     wget http://drupal.org/files/projects/drupal-x.y.tar.gz
     tar -zxvf drupal-x.y.tar.gz

   This creates a new directory drupal-x.y/ containing all Drupal files and
   directories. Copy the files into your Drupal installation directory:

     cp -R drupal-x.y/* drupal-x.y/.htaccess /path/to/your/installation

   If you do not have command line access to your server, download the archive
   from http://drupal.org using your web browser, extract it, and then use an
   FTP client to upload the files to your web root.

12. Re-apply any modifications to files such as .htaccess or robots.txt.

13. Make your settings.php file writeable, so that the update process can
   convert it to the format of Drupal 7.x. settings.php is usually located in

     sites/default/settings.php

14. Run update.php by visiting http://www.example.com/update.php (replace
   www.example.com with your domain name). This will update the core database
   tables.

   If you are unable to access update.php do the following:

   - Open settings.php with a text editor.

   - Find the line that says:
     $update_free_access = FALSE;

   - Change it into:
     $update_free_access = TRUE;

   - Once the upgrade is done, $update_free_access must be reverted to FALSE.

15. Backup your database after the core upgrade has run.

16. Replace and update your non-core modules and themes, following the
   procedures at http://drupal.org/node/948216

17. Go to Administration > Reports > Status report. Verify that everything is
   working as expected.

18. Ensure that $update_free_access is FALSE in settings.php.

19. Go to Administration > Configuration > Development > Maintenance mode.
   Disable the "Put site into maintenance mode" checkbox and save the
   configuration.