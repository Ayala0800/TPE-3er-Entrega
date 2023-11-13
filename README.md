# TPE-3er-Entrega
Integrantes : Agustina Quinteros (21agustinaa@gmail.com) - Lucas Ayala (lucasayala0800@gmail.com) 


En este trabajo se realiza una API REST (RESTful) donde se permite listar todas las cervezas y estilos de cervezas disponibles en la db, como tambien editar, eliminar y crear cervezas y estilos. Tambien se permite buscar una cerveza o estilo especifico mediante su ID.


## ENDPOINTS 


### _CERVEZAS_

**GET:/cervezas** -> Este Endpoint devuelve la lista de cervezas de la base de datos, que se mostraran de esta manera:

    [ {

		"id_cerveza": 2,
	
		"nombre": "Sureña",
	
		"IBU": 28,
	
		"ALC": 5,
	 
	 	"id_estilo": 6,
	  
	  	"stock": 30,
	   
	   	"descripcion": " ... ",
	    
	    	"estilo": "Amber Ale"
	     
     }, ...  ]

Ejemplo de request:

	GET localhost/WEB2/API/api/cervezas

    
**POST:/cervezas** -> Este endpoint crea una nueva cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)

	_error 401_: "Unauthorized" si no sos admnistrador

Ejemplo de request:

	POST localhost/WEB2/API/api/cervezas


**GET:/cervezas/:ID** -> Este Endpoint devuelve una cerveza especifica de la base de datos indicando su ID. Si no se encuentra
devuelve un mensaje de 

	_error 404_(NOT FOUND): "La cerveza con el id=' ' no existe."

Ejemplo de request:

	GET localhost/WEB2/API/api/cervezas/5


**PUT:/cervezas/:ID** -> Este endpoint modifica una cerveza (verificando antes si sos usuario autorizado para realizar la petición) especificando su ID. Si esta existe, devuelve un mensaje de

	_codigo 200_(OK): "La cerveza con el id=' ' ha sido modificada.".
 
 Caso contrario, devuelve un mensaje de 
 
 	_error 404_(NOT FOUND): "La cerveza con el id=' ' no existe." 

  	_error 401_: "Unauthorized" si no sos admnistrador
  


Ejemplo de request:

	PUT localhost/WEB2/API/api/cervezas/5

 
**DELETE:/cervezas/:ID** -> Este endpoint elimina una cerveza (verificando antes si sos usuario autorizado para realizar la petición) especificando su ID. Si esta existe, devuelve un mensaje de 

	_codigo 200_(OK): "La cerveza con el id=' ' ha sido borrada.". 
 
 Caso contrario, devuelve un mensaje de
 
 	_error 404_(NOT FOUND): "La cerveza con el id=' ' no existe." 

 	 _error 401_: "Unauthorized" si no sos admnistrador

Ejemplo de request:

	DELETE localhost/WEB2/API/api/cervezas/5



### _ESTILOS_

**GET:/estilos** -> Este Endpoint devuelve la lista de estilos de la base de datos, que se mostraran de esta manera:

	[ {

		"id_estilo": 1,

		"nombre": "Ginger pale ale"

	}, ... ]

 Ejemplo de request:

	GET localhost/WEB2/API/api/estilos

    
**POST:/estilos** -> Este endpoint agrega un nuevo estilo de cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)

	_error 401_: "Unauthorized" si no sos admnistrador

Ejemplo de request:

	POST localhost/WEB2/API/api/estilos

**GET:/estilos/:ID** -> Este Endpoint devuelve un estilo de cerveza especifico de la base de datos indicando su ID. Si no se encuentra
devuelve un mensaje de 

	_error 404_(NOT FOUND): "El estilo con el id=' ' no existe."

Ejemplo de request:

	GET localhost/WEB2/API/api/estilos/2

 
**PUT:/estilos/:ID** -> Este endpoint modifica un estilo de cerveza (verificando antes si sos usuario autorizado para realizar la petición) especificando su ID. Si este existe, devuelve un mensaje de _

	_codigo 200_(OK)_: "El estilo con el id=' ' ha sido modificado.".
 
Caso contrario, devuelve un mensaje de 

	_error 404_(NOT FOUND): "El estilo con el id=' ' no existe."

 	_error 401_: "Unauthorized" si no sos admnistrador

Ejemplo de request:

	PUT localhost/WEB2/API/api/estilos/2


**DELETE:/estilos/:ID** -> Este endpoint elimina un estilo de cerveza (verificando antes si sos usuario autorizado para realizar la petición) especificando su ID. Si este existe, devuelve un mensaje de 

	_codigo 200_(OK): "El estilo con el id=' ' ha sido borrado.".
 
Caso contrario, devuelve un mensaje de 

	_error 404_(NOT FOUND): "El estilo con el id=' ' no existe."

 	_error 401_: "Unauthorized" si no sos admnistrador


Ejemplo de request:

	DELETE localhost/WEB2/API/api/estilos/2



### _COMENTARIOS_

**GET:/comentarios** -> Este Endpoint devuelve la lista de comentarios realizados sobre una cerveza especifica de la base de datos, que se mostraran de esta manera:

	[ {
        
	 	"id_comentario": 1,
	 
	 	"descripcion": "Muy rica!",
	        
		"id_cerveza": 4,
	        
		"cerveza": "Raices"
 
 	}, ... ]

Ejemplo de request:

	GET localhost/WEB2/API/api/comentarios

    
**GET:/comentarios/:ID** -> Este Endpoint devuelve un comentario especifico de la base de datos indicando su ID. Si no se encuentra, devuelve un mensaje de 

	_error 404_(NOT FOUND): "El comentario con el id=' ' no existe."

Ejemplo de request:

	GET localhost/WEB2/API/api/comentarios/3

 
**DELETE:/comentarios/:ID** -> Este endpoint elimina un comentario de cerveza (verificando antes si sos usuario autorizado para realizar la petición) especificando su ID. Si este existe, devuelve un mensaje de 

	_codigo 200_(OK): "El comentario con el id=' ' ha sido borrado.".

Caso contrario, devuelve un mensaje de 

	_error 404_(NOT FOUND): "El comentario con el id=' ' no existe." 

Ejemplo de request:

	DELETE localhost/WEB2/API/api/comentarios/3


**POST:/comentarios** -> Este endpoint agrega un nuevo comentario de una cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición). Si el comentario se agrega correctamente se muestra _un codigo 200 (OK)_

Ejemplo de request:

	POST localhost/WEB2/API/api/comentarios



### _PAGINAR_

*Ruta de ejemplo para Paginar*

	http://localhost/WEB2/API/api/cervezas?per_page=5&page=1

- ?per_page: indica cuantos productos quiero mostrar por pagina, en este caso 5 (es decir, se mostraran la primeras 5 cervezas)

- ?page: indica que pagina mostrar, en este caso la 1.



### _FILTRAR_

*Ruta de ejemplo para Filtrar cervezas*=

	http://localhost/WEB2/API/api/cervezas?search_input=IPA

- ?search_input=nombre: en este caso va a filtrar todas las cervezas que en su nombre contengan el string "IPA".

Ejemplo de devolución:

	[ {
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
	 }, ... ]
	        "ALC": 15,
	        "id_estilo": 2,
	        "stock": 33,
	        "descripcion": "prueba",
	        "estilo": "IPA (india pale ale)"
	} ]

*Ruta de ejemplo para Filtrar comentarios*= http://localhost/WEB2/API/api/comentarios?search_input=Sureña

- ?search_input=sureña: en este caso va a filtrar todos los comentarios que pretenezca a la cerveza Sureña.

Ejemplo de devolución:
	    
     	{
	        "id_comentario": 2,
	        "detalle": "cerveza muy agradable en boca, ideal para epocas invernales",
	        "id_cerveza": 2,
	        "cerveza": "Sureña"
	},
	{
	        "id_comentario": 3,
	        "detalle": "riquisima",
	        "id_cerveza": 2,
	        "cerveza": "Sureña"
	}



 ### _ORDENAR_

Los resultados de la consulta pueden ordenarse según campos y órdenes ("asc" o "desc") especificados mediante los parámetros de consulta sort_by y order.

 *Ruta de ejemplo para Ordenar*=

 	http://localhost/WEB2/API/api/cervezas?sort_by=IBU&order=0

 - ?sort_by : este parámetro recibe un string que debe corresponder con uno de los campos de la entidad solicitada (el orden por defecto es de manera ASC por id_cerveza).

 - ?order : este parámetro recibe un número entero que puede ser 1 o 0. Si es 1 se ordenará la lista de manera descendiente. De ser 0 o cualquier otro número se ordenara ascendentemente.
