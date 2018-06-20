#!/usr/bin/env bats

#
# test-output.bats
#
# Test plugin command output
#

@test "output of plugin command" {
  run terminus code $TERMINUS_SITE.dev
  [[ "$output" == *"Cloning into '$TERMINUS_SITE'..."* ]]
  [ "$status" -eq 0 ]
}
