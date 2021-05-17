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
    public class ServicesController : Controller
    {
        private RailwayReservationEntities1 db = new RailwayReservationEntities1();

        // GET: Services
        public ActionResult Index()
        {
            if (!User.IsInRole("admin"))
            {
                var tickets = from ticket in db.tickets
                              where ticket.username == User.Identity.Name
                              select ticket;
                return View(tickets.ToList());
            }
            else
                return RedirectToAction("ServiceRequest");
           
        }

        // GET: Services/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Service service = db.Services.Find(id);
            if (service == null)
            {
                return HttpNotFound();
            }
            return View(service);
        }

        // GET: Services/Create
        public ActionResult Create()
        {
            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name");
            return View();
        }

        // POST: Services/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "ServiceId,pnr,Service1,Remark,Status")] Service service)
        {
            if (ModelState.IsValid)
            {
                if(service.Service1.Equals("Select your Service"))
                {
                    
                    ModelState.AddModelError("", $"Please select a service from the List");
                    return View();
                }
                service.Status = "Pending";
                db.Services.Add(service);
                db.SaveChanges();
                ModelState.AddModelError("", $"Your Request Has been Send to the Admin!! Please wait for sometime");
                return View();
                
            }

            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name", service.pnr);
            return View(service);
        }

        // GET: Services/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Service service = db.Services.Find(id);
            if (service == null)
            {
                return HttpNotFound();
            }
            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name", service.pnr);
            return View(service);
        }

        // POST: Services/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "ServiceId,pnr,Service1,Remark,Status")] Service service)
        {
            if (ModelState.IsValid)
            {
                db.Entry(service).State = EntityState.Modified;
                //ModelState.AddModelError("", $"serviceID :{service.ServiceId}, PNR= {service.pnr}, Service= {service.Service1}, Remark={service.Remark}, Status={service.Status} ");
                //return View();
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.pnr = new SelectList(db.tickets, "pnr", "name", service.pnr);
            return View(service);
        }

        // GET: Services/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Service service = db.Services.Find(id);
            if (service == null)
            {
                return HttpNotFound();
            }
            return View(service);
        }

        // POST: Services/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            Service service = db.Services.Find(id);
            db.Services.Remove(service);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        public ActionResult Status()
        {
            if (!User.IsInRole("admin"))
            {
                var services = from Service in db.Services
                              where Service.ticket.username == User.Identity.Name
                              select Service;
                return View(services.ToList());
            }
            else
            {
                var services = db.Services.Include(s => s.ticket);
                return View(services.ToList());
            }

        }
        [Authorize(Roles ="admin")]
        public ActionResult ServiceRequest()
        {
            var services = db.Services.Include(s => s.ticket);
            return View(services.ToList());
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
