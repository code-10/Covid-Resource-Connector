using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace RailwayReservation.Controllers
{

    [Authorize(Roles ="admin")]
    public class AdminController : Controller
    {
        private RailwayReservationEntities1 db = new RailwayReservationEntities1();

        // GET: Admin
        public ActionResult Index()
        {
            return View(db.Trains.ToList());
        }

        public ActionResult SeeTrains()
        {
            return RedirectToAction("Index","Trains");
        }

        public ActionResult SeeUsers()
        {
            return RedirectToAction("SeeUsers", "Users");
        }

        public ActionResult SeeFeedbacks()
        {
            return RedirectToAction("Index", "Feedbacks");
        }

        public ActionResult SeeTickets()
        {
            return RedirectToAction("Index", "Ticket");
        }
        public ActionResult ServiceRequest()
        {
            return RedirectToAction("ServiceRequest", "Services");
        }
    }
}