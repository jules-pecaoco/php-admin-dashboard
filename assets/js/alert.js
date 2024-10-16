function successfullRegisterAlert() {
  Swal.fire({
    title: "Registration Successful!",
    confirmButtonText: "OK",
    backdrop: `
    rgba(0, 0, 0, 0.5) 
    left top 
    no-repeat
  `,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "/";
    }
  });
}
