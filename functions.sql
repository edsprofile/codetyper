set serveroutput on

spool output.txt

create or replace function leaderboard return string as
       counter integer := 1;
       list varchar2(1000);
begin
       for score in (select *
                     from cs359score)
       loop
           list := list || 'Score: ' || score.score || 'Name: ' || score.user_name;
           counter := counter + 1;
           if counter >= 11 then
              exit;
           else
              list := list || ', ';
           end if;
       end loop;
       return list;
end;
/
show errors;

var test_list varchar2(2000);
exec :test_list := leaderboard;
print :test_list;

spool off
