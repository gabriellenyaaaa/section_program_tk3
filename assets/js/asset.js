function myFunction() {
  let angka1 = parseFloat(prompt("Masukan angka 1 :"));

  let angka2 = parseFloat(prompt("Masukan angka 2 :"));
  
  let operator = prompt("Masukan tanda operasi (+, -, *, /) :");

  let hasil;

  if (operator === "+") {
    hasil = angka1 + angka2;
  } else if (operator === "-") {
    hasil = angka1 - angka2;
  } else if (operator === "*") {
    hasil = angka1 * angka2
  } else if (operator === "/") {
    hasil = angka1 / angka2;
  }

  alert ("Hasil : " + hasil);
}