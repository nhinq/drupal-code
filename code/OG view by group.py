$group = og_get_group('node', $argument);
  if(!$group->gid) return false;
  $handler->argument = $group->gid;
  return true;