# TPE-3er-Entrega
Integrantes : Agustina Quinteros (21agustinaa@gmail.com) - Lucas Ayala (lucasayala0800@gmail.com) 


En este trabajo se realiza una API REST (RESTful) donde se permite listar todas las cervezas y estilos de cervezas disponibles en la db, como tambien editar, eliminar y crear cervezas y estilos. Tambien se permite buscar una cerveza o estilo especifico mediante su ID.
Ademas, se permite hacer una busqueda *filtrada* por un campo y *orden* (ASC ó DESC) especifico (el orden por defecto es de manera ASC por id_cerveza)

Ejemplo: **http://localhost/WEB2/API/api/cervezas?field=estilo&order=DESC**

## ENDPOINTS 

_CERVEZAS_



**GET:/cervezas** -> Este Endpoint devuelve la lista de cervezas de la base de datos, que se mostraran de esta manera:

    {

		"id_cerveza": 2,
	
		"nombre": "Sureña",
	
		"IBU": 28,
	
		"ALC": 5,
	 
	 	"id_estilo": 6,
	  
	  	"stock": 30,
	   
	   	"descripcion": " ... ",
	    
	    	"estilo": "Amber Ale"
	     
     },

    
**POST:/cervezas** -> Este endpoint crea una nueva cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)


**GET:/cervezas/:ID** -> Este Endpoint devuelve una cerveza especifica de la base de datos indicando su ID. Si no se encuentra
devuelve un mensaje tipo: "La cerveza con el id=' ' no existe."


**PUT:/cervezas/:ID** -> Este endpoint modifica una cerveza especificando su ID. Si esta existe, devuelve un mensaje tipo: "La cerveza con el id=' ' ha sido modificada.". Caso contrario, devuelve un mensaje tipo: "La cerveza con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)


**DELETE:/cervezas/:ID** -> Este endpoint elimina una cerveza especificando su ID. Si esta existe, devuelve un mensaje tipo: "La cerveza con el id=' ' ha sido borrada.". Caso contrario, devuelve un mensaje tipo: "La cerveza con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)



_ESTILOS_


**GET:/estilos** -> Este Endpoint devuelve la lista de estilos de la base de datos, que se mostraran de esta manera:

	{

		"id_estilo": 1,

		"nombre": "Ginger pale ale"

	}

    
**POST:/estilos** -> Este endpoint agrega un nuevo estilo de cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)


**GET:/estilos/:ID** -> Este Endpoint devuelve un estilo de cerveza especifico de la base de datos indicando su ID. Si no se encuentra
devuelve un mensaje tipo: "El estilo con el id=' ' no existe."


**PUT:/estilos/:ID** -> Este endpoint modifica un estilo de cerveza especificando su ID. Si este existe, devuelve un mensaje tipo: "El estilo con el id=' ' ha sido modificado.". Caso contrario, devuelve un mensaje tipo: "El estilo con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)


**DELETE:/estilos/:ID** -> Este endpoint elimina un estilo de cerveza especificando su ID. Si este existe, devuelve un mensaje tipo: "El estilo con el id=' ' ha sido borrado.". Caso contrario, devuelve un mensaje tipo: "El estilo con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)


_COMENTARIOS_


**GET:/comentarios** -> Este Endpoint devuelve la lista de comentarios realizados sobre una cerveza especifica de la base de datos, que se mostraran de esta manera:

	{
        
	 	"id_comentario": 1,
	 
	 	"descripcion": "Muy rica!",
	        
		"id_cerveza": 4,
	        
		"cerveza": "Raices"
 
 	}

    
**GET:/comentarios/:ID** -> Este Endpoint devuelve un comentario especifico de la base de datos indicando su ID. Si no se encuentra, devuelve un mensaje tipo: "El comentario con el id=' ' no existe."


**DELETE:/comentarios/:ID** -> Este endpoint elimina un comentario de cerveza especificando su ID. Si este existe, devuelve un mensaje tipo: "El comentario con el id=' ' ha sido borrado.". Caso contrario, devuelve un mensaje tipo: "El comentario con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)


**POST:/comentarios** -> Este endpoint agrega un nuevo comentario de una cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)


_PAGINAR_

*Ruta de ejemplo para Paginar*: http://localhost/WEB2/API/api/cervezas?per_page=5&page=1

- ?per_page: indica cuantos productos quiero mostrar por pagina, en este caso 5 (es decir, se mostraran la primeras 5 cervezas)

- ?page: indica que pagina mostrar, en este caso la 1.


_FILTRAR_

*Ruta de ejemplo para Filtrar*= http://localhost/WEB2/API/api/cervezas?search_input=IPA

- ?search_input=nombre: en este caso va a filtrar todas las cervezas que en su nombre contengan el string "IPA".

Ejemplo de devolución:

	{
	 	"id_cerveza": 6,
	        "nombre": "IPA",
	        "IBU": 56,
	        "ALC": 5,
	        "id_estilo": 2,
	        "stock": 60,
	        "descripcion": "Predominio de maltas caramelizadas...",
	        "estilo": "IPA (india pale ale)"
	},
	{	
	 	"id_cerveza": 32,
		"nombre": "Red IPA",
		"IBU": 12,
	        "ALC": 15,
	        "id_estilo": 2,
	        "stock": 33,
	        "descripcion": "prueba",
	        "estilo": "IPA (india pale ale)"
	},
	{
	        "id_cerveza": 33,
	        "nombre": "Black IPA",
	        "IBU": 12,
	        "ALC": 15,
	        "id_estilo": 2,
	        "stock": 33,
	        "descripcion": "prueba",
	        "estilo": "IPA (india pale ale)"
	}

