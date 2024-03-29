### 开机启动

+ 打开php-fpm

  ```bash 
  php-fpm --fpm-config /usr/local/etc/php-fpm.conf --prefix /usr/local/var
  ```

+ 打开nginx: 

  ```bash
  nginx -c /usr/local/etc/nginx/nginx.conf
  nginx -s reload
  ```

+ 打开mysql

  ```bash
  /usr/local/Cellar/mysql/8.0.15/bin/mysql.server restart
  ```


### .gitignore

* When you add something into a .gitignore file, try this:
```
git add [uncommitted changes you want to keep] && git commit
git rm -r --cached .
git add .
git commit -m "fixed untracked files"
```

* If you remove something from a .gitignore file, and the above steps don't work, try this:
```
git add -f [files you want to track again]
git commit -m "Refresh removing files from .gitignore file."

// For example, if you want the .java type file to be tracked again,
// The command should be:
//     git add -f *.java
```

### activityList.html的css样式说明

`style.css`:
```css
.content {
      float: left;
        padding: 1.875em;
          width: 100%; 
} /* 位于card类的外一层*/
```

`bootstrap.min.css`:
```css
.card {
        background-color: #fff;                 /* 背景颜色 */
        border: 1px solid rgba(0, 0, 0, .125);  /* 边框粗细、线型、颜色 */
        border-radius: .25rem                   /* 边框四角曲率 */
} /* 衬在表格下方的区域的属性，位于content类的内一层，table类的外一层 */

.table {
        background-color: transparent           /* 表格背景颜色 */
} /* 表格属性，位于card类的内一层 */
```

`bootstrap.min.css`定义了几种表格类的属性，例如`table-hover`表示带有悬停效果的表格样式。只要在html的`table`标签的`class`中添加`table-hover`即可使用。一张表格可以同时属于多个类，因此这些效果可以叠加。




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

(3) 下载smarty，将lib文件夹复制到web目录下，创建tpls目录，并在该目录下创建templates、templates_c、configs、cache目录。创建一个main.php，可以看我本地的代码，
    
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

### Mysql表说明
+ users
   + role 1 表示管理员（需要手动在MySQL数据库内修改）  0 表示普通用户，注册时默认均为普通用户
+ activities
+ user_activity
   + role 1 表示当前用户为该活动的管理员  0 表示普通与会人员

### 一些ideas 

+ 保持客户端登录状态
  + session
+ 表单的一些验证，如密码、确认密码一致；密码长度；用户名… 用js
+ common.php 中WEB_ROOT改成自己电脑上的配置
+ 防止sql注入：使用预处理语句
  + Php.ini 中 magic_quotes_gpc=on， display_errors=off
  + 数字类型的sql字段，将str转为int
+ Smarty有自动cache机制，可能会导致显示的数据与后台不同步
+ login里面记住密码、忘记密码
+ 现阶段可以实现管理员删除activity的操作，接下去可以在删除活动时，发送消息给所有与会人员
+ 超级管理员的activity页面，可以设置删除/修改等操作
+ 个人profile，以及个人信息的修改
+ 弹窗/确认栏的美化
+ deleteRecord.php 用户删除参与会议的记录，只需要修改user_activity表
+ 千万注意！！！！从MySQL中取出的值，就算是int型，在php中也是str，必须用intval()函数进行转化
+ 可以设置某些用户为活动的管理人员

5/4

* 统一界面的中英文
* activities增加了description和web address两项，要在注册活动时加入这两项
* 查看活动信息界面的美化（太丑了…）
* 管理员权限
  * 现在只有超级管理员可以设置活动管理员，要让活动的管理员也能给自己的活动加管理员（即增加一个普通用户对自己管理的活动的管理界面）
  * 管理员之间（超级管理员vs活动管理员，活动创建者vs活动管理员）是否需要分优先级
* 超级管理员添加删除用户账号功能
* 导出活动参加者的数据为JSON文件 & 导入JSON文件一次性添加多个活动参加者
* 活动开始时间必须早于结束时间的约束
* 后续还可以实现活动时间的分段以及每个时间段不同安排