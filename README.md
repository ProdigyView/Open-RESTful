#OpenREST
Version: 0.3.0

##What is OpenRest?
Open rest is a Restful API that deals with http request, responses, and authentication. The API is meant to be used in any structure, ranging from procedural code to implemented in an mvc.
##How To use
OpenRest main class is PVRestful that implements two interfaces. To set other objects, use dependency injection and pass the object in one of the mutator methods.

###Example

$rest = new PVRestful();
$rest -> setRequestObject(new PVRequest);
$rest -> getRequestData();

##Features
* Mobile Device Detection
* Mobile Device Retrievel
* Ajax Detection
* PUT, POST, GET, DELETE
* Auth Digest


##More To Come
Looking for input for further development or any developers that with to join.