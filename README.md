# TPE-3er-Entrega
Integrantes : Agustina Quinteros (21agustinaa@gmail.com) - Lucas Ayala (lucasayala0800@gmail.com) 
## ENDPOINTS 
###CERVEZAS
**GET:/cervezas** -> Este Endpoint devuelve la lista de cervezas de la base de datos, que se mostraran de esta manera:
	{
        "id_cerveza": 2,
        "nombre": "Sureña",
        "IBU": 28,
        "ALC": 5,
        "id_estilo": 6,
        "stock": 30,
        "descripcion": "A base de maltas caramelizadas que le otrogan un profundo , pero cristalino tono ambár con reflejos rojiizos. Cristalina y profunda como los lagos del sur argentino  ",
        "estilo": "Amber Ale"
    },
**POST:/cervezas** -> Este endpoint crea una nueva cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)
**GET:/cervezas/:ID** -> Este Endpoint devuelve una cerveza especifica de la base de datos indicando su ID. Si no se encuentra
devuelve un mensaje tipo: "La cerveza con el id=' ' no existe."
**PUT:/cervezas/:ID** -> Este endpoint modifica una cerveza especificando su ID. Si esta existe, devuelve un mensaje tipo: "La cerveza con el id=' ' ha sido modificada.". Caso contrario, devuelve un mensaje tipo: "La cerveza con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)
**DELETE:/cervezas/:ID** -> Este endpoint elimina una cerveza especificando su ID. Si esta existe, devuelve un mensaje tipo: "La cerveza con el id=' ' ha sido borrada.". Caso contrario, devuelve un mensaje tipo: "La cerveza con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)

###ESTILOS
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

###COMENTARIOS
**GET:/comentarios** -> Este Endpoint devuelve la lista de comentarios realizados sobre una cerveza especifica de la base de datos, que se mostraran de esta manera:
	{
        "id_comentario": 1,
        "descripcion": "Muy rica!",
        "id_cerveza": 4,
        "cerveza": "Raices"
    }
**GET:/ccomentarios/:ID** -> Este Endpoint devuelve un comentario especifico de la base de datos indicando su ID. Si no se encuentra, devuelve un mensaje tipo: "El comentario con el id=' ' no existe."
**DELETE:/comentarios/:ID** -> Este endpoint elimina un comentario de cerveza especificando su ID. Si este existe, devuelve un mensaje tipo: "El comentario con el id=' ' ha sido borrado.". Caso contrario, devuelve un mensaje tipo: "El comentario con el id=' ' no existe." (verificando antes si sos usuario autorizado para realizar la petición)
**POST:/estilos** -> Este endpoint agrega un nuevo comentario de una cerveza que sera agregada en la bd (verificando antes si sos usuario autorizado para realizar la petición)
