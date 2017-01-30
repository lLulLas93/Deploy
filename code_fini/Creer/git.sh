#!/bin/sh

 

case "$SSH_ORIGINAL_COMMAND" in

*\&*)

echo "Rejected"

;;

*\(*)

echo "Rejected"

;;

*\{*)

echo "Rejected"

;;

*\;*)

echo "Rejected"

;;

*\<*)

echo "Rejected"

;;

*\>*)

echo "Rejected"

;;

*\`*)

echo "Rejected"

;;

*\|*)

echo "Rejected"

;;

git)

$SSH_ORIGINAL_COMMAND

;;

*)

echo "Rejected"

;;

esac
