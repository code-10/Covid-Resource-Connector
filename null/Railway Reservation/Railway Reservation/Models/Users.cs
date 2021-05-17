using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Web;

namespace Railway_Reservation.Models
{

    [Table("user")]
    public class Users
    {
        [Key]
        public string Username { get; set; }
      
        public string Password { get; set; }
        public string Role { get; set; }
    }
}