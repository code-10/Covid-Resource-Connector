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
    public class LostFoundController : Controller
    {
        private RailwayReservationEntities1 db = new RailwayReservationEntities1();

        // GET: LostFound
        [Authorize(Roles = "admin")]
        public ActionResult Index()
        {
            var lostFounds = db.LostFounds.Include(l => l.Train);
            return View(lostFounds.ToList());
        }

        // GET: LostFound/Details/5
        [Authorize(Roles ="admin")]
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            LostFound lostFound = db.LostFounds.Find(id);
            if (lostFound == null)
            {
                return HttpNotFound();
            }
            return View(lostFound);
        }

        // GET: LostFound/Create
        public ActionResult Create()
        {
            ViewBag.train_id = new SelectList(db.tickets, "train_id", "name");
            return View();
        }

        // POST: LostFound/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "ItemId,ItemType,Brand,Colour,train_id")] LostFound lostFound)
        {
            if (ModelState.IsValid)
            {
                lostFound.Brand.ToLower().Trim();
                lostFound.Colour.ToLower().Trim();
                lostFound.ItemType.ToLower().Trim();
                db.LostFounds.Add(lostFound);
                db.SaveChanges();
                if (User.IsInRole("admin"))
                {
                    return RedirectToAction("Index");
                }
                else
                {
                    return RedirectToAction("Index", "Users", "");
                }
                
            }

            ViewBag.train_id = new SelectList(db.tickets, "train_id", "name", lostFound.train_id);
            return View(lostFound);
        }
        [Authorize(Roles = "admin")]
        // GET: LostFound/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            LostFound lostFound = db.LostFounds.Find(id);
            if (lostFound == null)
            {
                return HttpNotFound();
            }
            ViewBag.train_id = new SelectList(db.tickets, "train_id", "name", lostFound.train_id);
            return View(lostFound);
        }

        // POST: LostFound/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize(Roles = "admin")]
        public ActionResult Edit([Bind(Include = "ItemId,ItemType,Brand,Colour,train_id")] LostFound lostFound)
        {
            if (ModelState.IsValid)
            {
                db.Entry(lostFound).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.train_id = new SelectList(db.tickets, "train_id", "name", lostFound.train_id);
            return View(lostFound);
        }

        // GET: LostFound/Delete/5
        [Authorize(Roles = "admin")]
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            LostFound lostFound = db.LostFounds.Find(id);
            if (lostFound == null)
            {
                return HttpNotFound();
            }
            return View(lostFound);
        }

        // POST: LostFound/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            LostFound lostFound = db.LostFounds.Find(id);
            db.LostFounds.Remove(lostFound);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        public ActionResult Menu()
        {
            return View();
        }
        public ActionResult SearchLost()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult SearchLost([Bind(Include = "ItemId,ItemType,Brand,Colour,train_id")] LostFound lostFound)
        {
            if (ModelState.IsValid)
            {
                lostFound.Brand.ToLower().Trim();
                lostFound.Colour.ToLower().Trim();
                lostFound.ItemType.ToLower().Trim();

                
                var result = db.Database.SqlQuery<dynamic>("select ItemId from LostFound where Itemtype = '" + lostFound.ItemType + "' AND Brand = '" + lostFound.Brand + "' AND Colour = '" + lostFound.Colour + "' AND train_id = " + lostFound.train_id);
                if(result.Count()>0)
                {
                    ModelState.AddModelError("", $"Item Found!!! Please contact admin...");
                    return View();
                }
                else
                {
                    ModelState.AddModelError("", $"SORRY!!! Item Not Found");
                    return View();
                }
                
                
                

            }
            return View();
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
