import 'package:flutter/material.dart';
import 'package:news_app_mobile/api/posts_api.dart';
import 'package:news_app_mobile/models/post.dart';

class PostDetails extends StatefulWidget {

  final String postID;
  final String title="";
  PostDetails(this.postID);

  @override
  _PostDetailsState createState() => _PostDetailsState();
}

class _PostDetailsState extends State<PostDetails> {

  PostsApi _postsApi = PostsApi();

  @override
  Widget build(BuildContext context) {

    // This method is rerun every time setState is called, for instance as done
    // by the _incrementCounter method above.
    //
    // The Flutter framework has been optimized to make rerunning build methods
    // fast, so that you can just rebuild anything that needs updating rather
    // than having to individually change instances of widgets.
    return Scaffold(
      appBar: AppBar(
        // Here we take the value from the HomeScreen object that was created by
        // the App.build method, and use it to set our appbar title.
        title: Text(widget.title),

      ),
      body: Container(
        padding: EdgeInsets.all(24),
        child: FutureBuilder(
          future: _postsApi.fetchPostDetails(widget.postID),
          builder: (BuildContext context,AsyncSnapshot<Post> asyncSnapshot){
            switch(asyncSnapshot.connectionState){
              case ConnectionState.active:
              //STILL WORKING
                return _loading();

                break;
              case ConnectionState.waiting:
              //STILL WAITING

                return _loading();

                break;
              case ConnectionState.none:
              //ERROR
                return _error('No connection has been made');
                break;
              case ConnectionState.done:
              //COMPLETED

                if(asyncSnapshot.hasError){
                  return _error(asyncSnapshot.error.toString());
                }

                if(asyncSnapshot.hasData){
                  return _drawPostDetails(asyncSnapshot.data);
                }else{
                  return _error('No data fetched yet');
                }

                break;

            }
            return Container();
          },
        ),
      ),
    );


  }

  Widget _drawPostDetails(Post post){
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: ListView.builder(
        //itemCount: post.id,
        itemBuilder: (BuildContext context,int position){
          return InkWell(
            child: Card(
              child:Container(

                padding: const EdgeInsets.all(16),
                child: Text(post.post_content),

              ),
            ),

            onTap:(){

            },
          );
        },
      ),
    );

  }

  Widget _error(String error){
    return Container(
      child: Center(
        child: Text(error, style: TextStyle(color: Colors.red),),
      ),

    );
  }

  Widget _loading(){
    return Container(
      child: Center(
        child: CircularProgressIndicator(),
      ),

    );
  }
}