# yii-skeleton

This is a basic skeleton for Yii applications enhanced with composer.

## Installation

For project initialization you can run simply the command below:

<code>$ composer create-project bartaakos/yii-skeleton MyNewProject</code>

After the project is created this command creates the two configuration files (<code>custom.php</code>, <code>params.php</code>) automatically by copying them from the distribution versions. **You should override them as soon as the command is finished.**

## Static files

<pre>
/web/assets
/vendor
/runtime
/config/custom.php
/config/params.php
</pre>

The files listed above are ignored and you should handle them as static content.

## Maintenance

### [nDeploy](https://github.com/Netpositive/ndeploy)

This is a very convenient tool for high-level site maintenance.

For installation please check nDeploy's readme. The final <code>build.properties</code> should look like something like this:

<pre>
;-- deploy basedir --
basedir=/home/my-new-project

;-- application --
application.name=my-new-project
application.framework=yii
;application.deploydir=/home/my-new-project/current
;application.repositorydir=/home/my-new-project/src/my-new-project
;application.releasesdir=/home/my-new-project/releases
application.releaseskept=10

;-- scm properties --
scm.type=git
scm.repository=repository-of-my-new-project.git
;scm.branch=master
;scm.git.extra.path.pull=


;-- shared files --
shared.files=config/custom.php,config/params.php,runtime,web/assets,vendor

;-- vendor --
vendor=composer
vendor.command=update

;-- yii framework properties --
application.framework.extra.migrate.command=./yiic
application.framework.extra.migrate=true
application.framework.extra.migrate.ask=false

;-- maintenance --
;maintenance=false
;maintenance.source=
;maintenance.destination=
;maintenance.remove=true

;-- hash --
;hash=true
;hash.file=

;-- lock --
;lock=true
;lock.file=

;-- ndpeloy build target's basedir --
ndeploy.basedir=/home/ndeploy/current
</pre>

Note that I removed the <code>yiic migration</code> after <code>composer update/install</code> because we do that with nDeploy as you can see. If you need to get that back simply uncomment those lines in the params in <code>console/console.php</code> and set <code>application.framework.extra.migrate</code> to <code>false</code> in <code>build.properties</code>.

## Credits

[Netpositive](http://netpositive.hu)
