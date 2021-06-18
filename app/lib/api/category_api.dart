import 'package:http/http.dart' as http;
import 'api_util.dart';
import 'dart:io';
class CategoriesApi{

  fetchAllCategories() async{
    var _client = HttpClient();
    _client.badCertificateCallback = ((X509Certificate cert, String host, int port) => true);

    String allCategories=ApiUtil.MAIN_API_URL+ApiUtil.ALL_CATEGORIES;
    Map<String,String> headers={
      'Accept' : 'application/json',
      'Content-Type' : 'application/json',
    };

    var uriResponse = await _client.getUrl(Uri.parse(allCategories)).then((response){
      print(response.headers);
    });

  }
}
