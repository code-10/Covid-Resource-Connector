using RailwayReservation.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Web.Security;

namespace RailwayReservation.Controllers
{
    [AllowAnonymous]
    public class AccountController : Controller
    {
        // GET: Account
        public ActionResult Login()
        {
            return View();
        }
        [HttpPost] 
        public ActionResult Login(RailwayReservation.Models.User user)
        {
            using (var context =new RailwayReservationEntities1())
            {
                bool isVaild = context.Users.Any(x => x.username == user.Username && x.password == user.Password);
                if(isVaild)
                {
                    FormsAuthentication.SetAuthCookie(user.Username, false);
                    var newVisitor = new visitor_count();
                    newVisitor = context.visitor_count.Find(101) ;
                    
                    newVisitor.Id = 101;
                    newVisitor.visitor_no = context.visitor_count.Find(101).visitor_no + 1;

                    context.Entry(newVisitor).State = System.Data.Entity.EntityState.Modified;
                   
                    //VISITOR COUNT
                    bool isAdmin = context.UserRoles.Any(x => x.username == user.Username && x.role.Equals("admin"));
                    context.SaveChanges();
                    if (isAdmin)
                    {
                        return RedirectToAction("Index", "Admin");
                    }
                    return RedirectToAction("Index", "Users");
                }
                ModelState.AddModelError("","Invalid Username or Password");
            }
            return View();
        }

        public ActionResult Signup()
        {
            return View();
        }
        [HttpPost]
        public ActionResult Signup(User user, RailwayReservation.Models.User users)
        {
            using (var context = new RailwayReservationEntities1())
            {
                bool isVaild = context.Users.Any(x => x.username == users.Username );
                if (isVaild)
                {
                    ModelState.AddModelError("", "Username Already exist");
                    return View(); 
                }
            }

            using (var context =new RailwayReservationEntities1())
            {
                
                context.Users.Add(user);
                context.UserRoles.Add(new UserRole() { role = "user",User=user ,username=user.username });
                context.SaveChanges();
            }
            return RedirectToAction("login");
        }

        public ActionResult Logout()
        {
            FormsAuthentication.SignOut();
            return RedirectToAction("Login");
        }
    }
}