//PETICIONES FETCH:
const getObjeto = async() => {
	try { //Se ejecuta cuando no hay errores
		const res = await fetch("template-php/accounts/es.json");
		const objeto = await res.json();

		function obtenerValor(clave) {
		    return objeto[clave];
		}

		for (let clave in objeto) {
		    const valor = obtenerValor(clave);
		    console.log(`Clave: ${clave}, Valor: ${valor}`);
		}
	} catch(error) { //Se ejecuta cuando hay errores
		console.log(error);
	} finally { //Se ejecuta siempre (hayan o no hayan errores)
		console.log("Funciona xd");
	}
}

getObjeto();
