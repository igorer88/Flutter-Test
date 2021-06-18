import 'package:http/http.dart' as http;
import 'dart:convert';
import 'api_util.dart';
import 'package:news_app_mobile/models/post.dart';

class PostsApi{

  // DECLARATION OF VARIABLE

  Post post; //OBJET POST
  List<Post> posts=[]; //LIST OF POSTS

  var uriResponse; // GET A RESPONSE OF REQUEST
  http.Client client; // THIS IS A HTTP CLIENT

  Uri uriRequest;

  // FUNCTON FOR GET ALL CATEGORIES
  Future<List<Post>> fetchAllPosts() async{

    // HTTP REQUEST URI
    uriRequest=Uri.parse(ApiUtil.MAIN_API_URL+ApiUtil.ALL_POSTS);

    // HTTP REQUEST HEADERS
    Map<String,String> headers={
      'Accept' : 'application/json',
      'Content-Type' : 'application/json',
    };

    client = new http.Client();

    try {
      uriResponse = await client.get(uriRequest,headers: headers);

      if(uriResponse.statusCode==200){

        Map<String,dynamic> body=jsonDecode(uriResponse.body);

        if(body.isEmpty){
          print('No record');
        }

        // LOADING CATEGORIES DATA IN LIST OF CATEGORIES
        for( var item in body['data']){
          post=Post.fromJson(item);
          posts.add(post);
        }

      }else{
        print('error');
      }

      return posts;

    } finally {
      client.close();
    }

  }

  Future<Post> fetchPostDetails(String postID) async{

    uriRequest=Uri.parse(ApiUtil.POST_DETAILS(postID));

    Map<String,String> headers={
      'Accept' : 'application/json',
      'Content-Type' : 'application/json',
    };

    client = new http.Client();

    try {
      uriResponse = await client.get(uriRequest,headers: headers);

      if(uriResponse.statusCode==200){

        Map<String,dynamic> body=jsonDecode(uriResponse.body);

        if(body.isEmpty){
          print('No record');
        }

        post=Post.fromJson(body['data']);

      }else{
        print('error');
      }
      return post;
    }
    finally {
      client.close();
    }

  }

}