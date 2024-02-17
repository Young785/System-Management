(function () {
  document.getElementById("basic-alert").onclick = function () {
    Swal.fire("Hello this is Basic alert message")
  }
    ,
    document.getElementById("alert-text").onclick = function () {
      Swal.fire("The Internet ?", "That thing is still around ?", "question")
    }
    ,
    document.getElementById("alert-footer").onclick = function () {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Something went wrong!",
        footer: '<a href="">Why do I have this issue?</a>'
      })
    }
    ,
    document.getElementById("long-window").onclick = function () {
      Swal.fire({
        imageUrl: "https://placeholder.pics/svg/300x1500",
        imageHeight: 1500,
        imageAlt: "A tall image"
      })
    }
    ,
    document.getElementById("alert-description").onclick = function () {
      Swal.fire({
        title: "<strong>HTML <u>example</u></strong>",
        icon: "info",
        html: 'You can use <b>bold text</b>, <a href="//sweetalert2.github.io">links</a> and other HTML tags',
        showCloseButton: !0,
        showCancelButton: !0,
        focusConfirm: !1,
        confirmButtonText: '<i class="fe fe-thumbs-up"></i> Great!',
        confirmButtonAriaLabel: "Thumbs up, great!",
        cancelButtonText: '<i class="fe fe-thumbs-down"></i>',
        cancelButtonAriaLabel: "Thumbs down"
      })
    }
    ,
    document.getElementById("three-buttons").onclick = function () {
      Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: !0,
        showCancelButton: !0,
        confirmButtonText: "Save",
        denyButtonText: "Don't save"
      }).then(e => {
        e.isConfirmed ? Swal.fire("Saved!", "", "success") : e.isDenied && Swal.fire("Changes are not saved", "", "info")
      }
      )
    }
    ,
    document.getElementById("alert-dialog").onclick = function () {
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: !1,
        timer: 1500
      })
    }
    ,
    document.getElementById("deleteManager").onclick = function () {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(e => {
        e.isConfirmed && Swal.fire("Deleted!", "Your file has been deleted.", "success")
      }
      )
    }
    ,
    document.getElementById("alert-parameter").onclick = function () {
      const e = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success ms-2",
          cancelButton: "btn btn-danger"
        },
        buttonsStyling: !1
      });
      e.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
      }).then(t => {
        t.isConfirmed ? e.fire("Deleted!", "Your file has been deleted.", "success") : t.dismiss === Swal.DismissReason.cancel && e.fire("Cancelled", "Your imaginary file is safe :)", "error")
      }
      )
    }
    ,
    document.getElementById("alert-image").onclick = function () {
      Swal.fire({
        title: "Sweet!",
        text: "Modal with a custom image.",
        imageUrl: "https://laravelui.spruko.com/vexel/build/assets/images/media/2.jpg",
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: "Custom image"
      })
    }
    ,
    document.getElementById("alert-custom-bg").onclick = function () {
      Swal.fire({
        title: "Custom width, padding, color, background.",
        width: 600,
        padding: "3em",
        color: "#716add",
        background: "url(https://laravelui.spruko.com/vexel/build/assets/images/media/1.jpg)",
        backdrop: `
              rgba(0,0,0,0.3)
              url(https://laravelui.spruko.com/vexel/build/assets/images/gif's/1.gif)
              left top
              no-repeat
            `
      })
    }
    ,
    document.getElementById("alert-auto-close").onclick = function () {
      let e;
      Swal.fire({
        title: "Auto close alert!",
        html: "I will close in <b></b> milliseconds.",
        timer: 2e3,
        timerProgressBar: !0,
        didOpen: () => {
          Swal.showLoading();
          const t = Swal.getHtmlContainer().querySelector("b");
          e = setInterval(() => {
            t.textContent = Swal.getTimerLeft()
          }
            , 100)
        }
        ,
        willClose: () => {
          clearInterval(e)
        }
      }).then(t => {
        t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
      }
      )
    }
}
)();
