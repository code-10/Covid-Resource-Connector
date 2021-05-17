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
    public class FeedbacksController : Controller
    {
        private RailwayReservationEntities1 db = new RailwayReservationEntities1();

        // GET: Feedbacks
        public ActionResult Index(RailwayReservation.Models.User users)
        {
            if (User.IsInRole("admin"))
            {
                var feedbacks = db.Feedbacks.Include(f => f.User);
                return View(feedbacks.ToList());
            }
            else
            {
                using (var context = new RailwayReservationEntities1())
                {

                    var model = from r in db.Feedbacks
                                where r.username == User.Identity.Name
                                select r;
                    return View(model);

                }

            }
        }

        // GET: Feedbacks/Details/5
        public ActionResult Details(int? id)
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

        // GET: Feedbacks/Create
        public ActionResult Create()
        {
            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name");
            ViewBag.username = new SelectList(db.Users, "username", "password");
            return View();
        }

        // POST: Feedbacks/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,username,feedback_msg,pnr,admin_reply")] Feedback feedback)
        {
            if (ModelState.IsValid)
            {
                feedback.pnr = feedback.Id;
                feedback.Id = 0;
                feedback.admin_reply = " ";
                db.Feedbacks.Add(feedback);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name", feedback.pnr);
            ViewBag.username = new SelectList(db.Users, "username", "password", feedback.username);
            return View(feedback);
        }

        // GET: Feedbacks/Edit/5
        public ActionResult Edit(int? id)
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
            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name", feedback.pnr);
            ViewBag.username = new SelectList(db.Users, "username", "password", feedback.username);
            return View(feedback);
        }

        // POST: Feedbacks/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,username,feedback_msg,pnr,admin_reply")] Feedback feedback)
        {
            if (ModelState.IsValid)
            {
                
                db.Entry(feedback).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name", feedback.pnr);
            ViewBag.username = new SelectList(db.Users, "username", "password", feedback.username);
            return View(feedback);
        }

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
