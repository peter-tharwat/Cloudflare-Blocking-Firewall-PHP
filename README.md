# Cloudflare-Blocking-Firewall-PHP
Cloudflare Blocking Firewall PHP (Block and unBlock IP)

Blocking Ip

`
(new SecurityHelper)->blockIp($IP);
`

unBlockIp

`
(new SecurityHelper)->unBlockIp($state_id);
`

StateId That you have received from blocking ip

Enable Under Attack Mode

`(new \App\Helpers\SecurityHelper)->enableUnderAttackMode();`

Disable Under Attack Mode

`(new \App\Helpers\SecurityHelper)->disableUnderAttackMode();`

---------
Thanks

