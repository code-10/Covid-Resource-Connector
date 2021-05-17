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
    public class TicketController : Controller
    {
        private RailwayReservationEntities1 db = new RailwayReservationEntities1();

        // GET: Ticket
        public ActionResult Index()
        {
            if (User.IsInRole("admin"))
            {
                var tickets = db.tickets.Include(t => t.User).Include(t => t.Train);
                return View(tickets.ToList());
            }
            else
            {

                var tickets = from ticket in db.tickets
                              where ticket.username == User.Identity.Name
                              select ticket;
                    return View(tickets);    
            }
            
        }

        // GET: Ticket/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ticket ticket = db.tickets.Find(id);
            if (ticket == null)
            {
                return HttpNotFound();
            }
            return View(ticket);
        }

        // GET: Ticket/Create
        public ActionResult Create()
        {
            ViewBag.username = new SelectList(db.Users, "username", "password");
            ViewBag.train_id = new SelectList(db.Trains, "train_id", "source");
            return View();
        }

        // POST: Ticket/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "pnr,name,source,destination,date,class,username,train_id,fare")] ticket ticket)
        {
            if (ModelState.IsValid)
            {
               
                ticket.username = User.Identity.Name;
                if (ticket.source.Equals(ticket.destination))
                {
                    ModelState.AddModelError("", "Source and Destination cannot be same");
                    return View();
                }
                if ((ticket.date.Year < DateTime.Today.Year) ||
                    (ticket.date.Year >= DateTime.Today.Year && ticket.date.Month < DateTime.Today.Month) || 
                    (ticket.date.Year >= DateTime.Today.Year && ticket.date.Month >= DateTime.Today.Month && ticket.date.Day < DateTime.Today.Day))
                {
                    ModelState.AddModelError("", "Please enter the valid PRESENT or FUTURE date " );
                    return View();
                }
                var trains = db.Trains.Where(x => x.source == ticket.source && x.destination == ticket.destination).FirstOrDefault();

                if (trains == null)
                {
                    ModelState.AddModelError("", "Sorry!!!, No train available for this route");
                    return View();
                }

                //FARE CALCULATION
                if (ticket.@class.Equals("Sleeper"))
                {
                    ticket.fare = trains.fare;
                }
                else if (ticket.@class.Equals("AC 3 Tier"))
                {
                    ticket.fare = (int)((double)trains.fare * 1.5);
                }
                else
                {
                    ticket.fare = trains.fare * 2;
                }

                ticket.train_id = trains.train_id;
                
                db.tickets.Add(ticket);
                db.SaveChanges();
                return View("Successful", ticket);
                
            }

            ViewBag.username = new SelectList(db.Users, "username", "password", ticket.username);
            ViewBag.train_id = new SelectList(db.Trains, "train_id", "source", ticket.train_id);
            
            return View(ticket);
        }

        // GET: Ticket/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ticket ticket = db.tickets.Find(id);
            if (ticket == null)
            {
                return HttpNotFound();
            }
            ViewBag.username = new SelectList(db.Users, "username", "password", ticket.username);
            ViewBag.train_id = new SelectList(db.Trains, "train_id", "source", ticket.train_id);
            return View(ticket);
        }

        // POST: Ticket/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "pnr,name,source,destination,date,class,username,train_id,fare")] ticket ticket)
        {
            if (ModelState.IsValid)
            {
                db.Entry(ticket).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.username = new SelectList(db.Users, "username", "password", ticket.username);
            ViewBag.train_id = new SelectList(db.Trains, "train_id", "source", ticket.train_id);
            return View(ticket);
        }

        // GET: Ticket/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            ticket ticket = db.tickets.Find(id);
            if (ticket == null)
            {
                return HttpNotFound();
            }
            return View(ticket);
        }

        // POST: Ticket/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            ticket ticket = db.tickets.Find(id);
            db.tickets.Remove(ticket);
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
