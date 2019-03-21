### 环境配置

**For Ubuntu**

安装配置nginx+php+mysql:

   https://blog.51cto.com/13791715/2161170

**For mac**

(1) 下载nginx，配置nginx配置文件

   https://segmentfault.com/a/1190000014610688

   ```
       server {
           listen       8080;
           server_name  localhost;
           #charset koi8-r;
           root /Users/songchenlei/Desktop/Project-on-Computer-Network/project/web;
   
           #access_log  logs/host.access.log  main;
   
           location / {
               index index.php;
               #autoindex on;
               autoindex_exact_size off;
               autoindex_localtime on;
           }
   
           location ~ \.php$ {
               #proxy_pass   http://127.0.0.1;
               fastcgi_pass  127.0.0.1:9000;
               fastcgi_index index.php;
               fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
               include       fastcgi_params;
           }
   ```

(2) 安装下载php-fmp

   https://blog.csdn.net/ivan820819/article/details/54970330

   https://lzw.me/a/mac-osx-php-fpm-nginx-mysql.html

(3) ~~下载smarty，将lib文件夹复制到web目录下，创建tpls目录，并在该目录下创建templates、templates_c、configs、cache目录。创建一个main.php，可以看我本地的代码，~~
    
   smarty库已经在`project/smarty3`中，不需要重新下载，只需要修改配置文件`project/config.php`

   分隔符设置的是{%和%}

   https://www.open-open.com/solution/view/1319016010156

(4) 安装配置MySQL 修改密码`ALTER USER 'root'@'localhost' IDENTIFIED BY 'chichichi!';`

   ```sql
   ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password
   BY 'password';  
   ```

**For Windows**

http://www.nginx.cn/4514.html

或使用Win10内置的WSL功能，安装Ubuntu子系统，再按Linux的方法进行安装和配置



### 一些ideas 

+ 公共的header 和 footer
  + jQuery的load方法
  + 转化成js代码，再加载进html
  + ajax
  + Django
+ 保持客户端登录状态
  + session
  + token
+ 表单的一些验证，如密码、确认密码一致；密码长度；用户名… 用js
+ common.php 中WEB_ROOT改成自己电脑上的配置
+ 防止sql注入：使用预处理语句
  + Php.ini 中 magic_quotes_gpc=on， display_errors=off
  + 数字类型的sql字段，将str转为int
+ Smarty有自动cache机制，可能会导致显示的数据与后台不同步
+ login里面记住密码、忘记密码
