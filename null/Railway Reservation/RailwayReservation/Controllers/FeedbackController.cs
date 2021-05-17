using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using RailwayReservation;

namespace RailwayReservation.Controllers
{
    [Authorize]
    public class FeedbackController : Controller
    {
        private RailwayReservationEntities1 db = new RailwayReservationEntities1();

        // GET: Feedbacks
        

        
        // GET: Feedbacks/Create
        public ActionResult Create()
        {
            ViewBag.username = new SelectList(db.Users, "username", "password");
            return View();
        }

        // POST: Feedbacks/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,username,feedback_msg,pnr")] Feedback feedback)
        {
            if (ModelState.IsValid)
            {
                feedback.username = User.Identity.Name;
               
                if (User.Identity.Name.Equals(feedback.username))
                {

                    feedback.pnr = feedback.Id;
                    feedback.Id = 0;
                    db.Feedbacks.Add(feedback);
                    db.SaveChanges();
                    return RedirectToAction("Index");
                }
                else
                {
                    ModelState.AddModelError("", "Invalid User Providing Feedback");
                    return View();
                }
                
            }

            ViewBag.username = new SelectList(db.Users, "username", "password", feedback.username);
            return View(feedback);
        }
        [Authorize(Roles = "admin")]
        // GET: Feedbacks/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Feedback feedback = db.Feedbacks.Find(id);
            if (feedback == null)
            {
                return HttpNotFound();
            }
            return View(feedback);
        }


        // POST: Feedbacks/Delete/5
        [Authorize(Roles = "admin")]
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Feedback feedback = db.Feedbacks.Find(id);
            db.Feedbacks.Remove(feedback);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
