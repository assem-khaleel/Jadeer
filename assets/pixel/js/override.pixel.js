
// Added by shamaseen [this function to override menu collapse in pixeladmin.js]
// [pathUsedIn: /var/www/html/jadeer/application/views/common/navigation.php]
function extend(e)
{
    if(e.parent().hasClass("px-nav-expand"))
    {
       e.parent().removeClass("px-nav-expand");
    }
    else
    {
       e.parent().addClass("px-nav-expand");
    }
}