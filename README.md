# greetingsystem

Script runs everyday:

# crontab -l
# 1* Minute ; 2* Hour ; 3* day of month ; 4*  month 5* ; day of week

0 7 * * * php .../includes/send_daily_mail.php
