<?php

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['summary'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 *
 * @ingroup themeable
 */
?>
<style>
body {
	font-family:Arial, Helvetica, sans-serif
}
#buddyicon {
	width:130px;
	float:left;
}
#buddyicon img {
	width:124px;
}
#userdesc {
	float:right;
	width:150px;
	word-wrap: break-word;
	margin-bottom:8px;
}
#userdesc h2 {
	margin-top:0;
	font-size:1.5em;
	font-family:Arial, Helvetica, sans-serif
}
.profile .user-picture {
	margin:0!important;
	float:left
}
.right li {
	list-style:none;
	font-size:12px;
}
.unit .actions {
	padding-left:0
}
.box h3{font-size:14px; font-weight:bold}
#activities li{background-position:0 -1010px; }
.right .box{margin-bottom:20px;}
.right .box ul{padding-left:0}
.right .box ul li{line-height:16px; padding:2px 0}
.left .views-field-title, .left .views-field-name{ display:none}
.left td{padding-bottom:20px;}
.left td a{border:1px solid #fff ; float:left; width:100%}
.left td a:hover {border:1px solid #ccc}
.left td a img{}
.view_c{background-position:0 -626px}
.createit{background-position:0 -466px}
.organizer_btn{background-position:0 -370px}
.add_contact_btn, .invite_group_btn{background-position:0 -786px}
</style>
<div class="profile"<?php print $attributes; ?>>
  <div class="left" style="width:600px; float:left"><h2>Items</h2><?php print views_embed_view('likes', 'block_1', $user_id);?></div>
  <div class="right" style="width:300px; float:right">
    <div id="profile" class="box" style="margin-bottom:16px;">
      <div class="bd">
        <div class="icon_desc clearfix" style="margin-bottom:16px;">
          <div id="buddyicon"><?php print render($user_profile['user_picture']) ?></div>
          <div class="unit filling_block" id="userdesc">
            <h2 class="username"><?php print $user_name?></h2>
            <div>Joined <?php print $user_profile['summary']['member_for']['#markup'];?> ago</div>
          </div>
        </div>
        <div class="unit" style="clear:left; margin-bottom:8px;">
          <ul class="actions">
            <li class="actions"><span><a href="<?php print base_path()?>?q=user/<?php print $user_id?>/edit">Settings</a></span></li>
          </ul>
        </div>
      </div>
    </div>
    <div id="activities" class="box clearfix" trackcontext="">
      <div class="bd">
        <ul class="activity_summary">
          <li onclick="">
            <div class="sprites view_c"></div>
            <?php $view = views_get_view('likes'); $view->set_arguments(array($user_id)); $view->execute(); print count($view->result); ?> item likes</li>
        </ul>
      </div>
    </div>
    <div class="box" trackcontext="">
      <div title="" class="hd">
        <h3>Toolbox</h3>
      </div>
      <div class="bd">
        <ul class="actions">
          <li class="actions">
            <div class="sprites createit"></div>
            <a href="#">Create a set</a></li>
          <li class="actions">
            <div class="sprites createit"></div>
            <a href="#">Create a collection</a></li>
          <li class="actions">
            <div class="sprites organizer_btn"></div>
            <a href="#">Organize items</a></li>
          <li class="actions">
            <div class="sprites add_contact_btn"></div>
            <a href="#">Find members to follow</a></li>
          <li class="actions">
            <div class="sprites invite_group_btn"></div>
            <a href="#">Join a group</a></li>
        </ul>
      </div>
    </div>
    <div class="box" trackcontext="">
      <div title="" class="hd">
        <h3>Following</h3>
        <ul class="actions inline right">
          <li class="actions" style="display:block; text-align:right"><span>Find members to follow</span></li>
        </ul>
      </div>
      <div class="bd">
        <?php print views_embed_view('find_members_to_follow', 'default');?>
      </div>
    </div>
  </div>
  <?php //print render($user_profile); ?>
</div>
