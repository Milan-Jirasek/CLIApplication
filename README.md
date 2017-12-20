# CLIApplication
Vodafone homework

## Application installation and usage
- composer install
- start command, for example: **php src/console api:location:get-zip London Manchester Hampshire**
- enjoy your location informations :)

## Tasks processing
### Mandatory tasks
- Create an php cli application that will get UK postcodes by entering their names. - **OK**
  - Command actually write all informations into output, because there is much more post codes than one for most of 
  cities. Can be changed **execute function** in **/src/Command/GetZipsByCities.php** easily 
  - Command is executed by this console command: **php src/console api:location:get-zip London Manchester Hampshire**
- The application will be able to search exactly for two or three cities at one. 
If a user enters one city or more than three, the application will display error message. - **OK**
  - Counts can be defined in **/config/config.yml**.
- You’ll have to use this public SOAP service: http://www.webservicex.net/uklocation.asmx?WSDL - **OK**
  - Wsdl can be defined in **/config/config.yml**.
- Present a good error handling. If the endpoint is down, you’ll have to display an understandable error message. - **OK**
  - Error handling is directly in **/src/console**. 
  - For this application is represented only by writing exception message and exit with different codes. Instead of this 
  can be used some logger, connection to some communication services, that will notice developers instantly etc.
- Use Symfony 3 components to run the application. Do not use Symfony framework as a whole, it will be an overkill. - **OK**
- Find a suitable SOAP client and use it (hint: consider this package:https://github.com/tuscanicz/BeSimpleSoap) - **OK**
- Include at least one unit test. - **OK**

### Optional tasks
- HTTP website with form is optional. - **NOT OK**
  - I didn't do this, because of two reasons
    - First there is request for not use whole symfony framework, but I don't know how to do this without whole fw.
    - Second Christmas is coming and we are in hurry about my possible hiring :)
- You can include Travis CI to execute your unit tests, check for coding standards etc. via Phing. This is also optional. - **OK**
  - I saw this first time, so there is only test execution, probably travis configuration can be written better. 
- Full code coverage is optional :-) - **OK**
