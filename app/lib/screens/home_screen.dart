import 'package:flutter/material.dart';
import 'package:news_app_mobile/models/post.dart';
import 'package:news_app_mobile/api/posts_api.dart';
import 'package:news_app_mobile/screens/post_details.dart';

class HomeScreen extends StatefulWidget {

    @override
    _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {

    PostsApi _postsApi = PostsApi();

    @override
    void initState() {
      super.initState();
    }

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
                title: Text('News App'),

            ),

            body: Container(
                child: FutureBuilder(
                      future: _postsApi.fetchAllPosts(),
                      builder: (BuildContext context,AsyncSnapshot<List<Post>> asyncSnapshot){
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
                                      return _drawHomeScreen(asyncSnapshot.data);
                                    }

                                 break;
                          }
                        return Container();
                      },
                ),
          ),

            drawer: Drawer(
              child: ListView(
                  children: <Widget>[
                    DrawerHeader(
                        decoration: BoxDecoration(color: Colors.red),
                        child: Text('Header'),
                    ),
                    ListTile(
                      title: Text('Categories'),
                      onTap: (){
                            Navigator.of(context).pop();
                            Navigator.pushNamed(context, '/categories');
                      },
                    )
                  ],
              ),
          ),
        );

    }

    Widget _drawHomeScreen(List<Post> posts){
      List<Post> postsWithImages=[];
      for(Post post in posts){
        if(post.images.length>0){
          postsWithImages.add(post);
        }
      }
      return Column(
          children: <Widget>[
            _sliders(postsWithImages),
            _postsList(posts),
          ],
      );
    }

    Widget _postsList(List<Post> posts){
      return Flexible(
        child: Padding(
          padding: const EdgeInsets.all(16) ,

          child : ListView.builder(
            itemCount: posts.length,
            itemBuilder: (BuildContext context,int position){
              return Card(
                child: InkWell(

                    onTap:(){

                      Navigator.push(context, MaterialPageRoute(builder: (context) => PostDetails(posts[position].post_id)));

                    },
                    child:Container(
                        padding: EdgeInsets.all(16),
                        child : Column(
                          mainAxisAlignment: MainAxisAlignment.start,
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: <Widget>[
                            Text(
                              posts[position].post_title,
                              style: TextStyle(
                                  color: Colors.black,
                                  fontSize: 22
                              ),
                            ),
                            SizedBox(height: 20),
                            Text('${posts[position].author.first_name} ${posts[position].author.first_name}',

                                style: TextStyle(color: Colors.blueGrey)
                            ),
                          ],
                        )
                    )

                ),

              );
            },
          ),

        ),
      );
    }

    Widget _sliders(List<Post> posts){
          return Container(
              height: MediaQuery.of(context).size.height*0.25,
              child: PageView.builder(
                  itemCount:  posts.length,
                  itemBuilder: (BuildContext context, int position){
                  return InkWell(
                    onTap: (){

                    },
                    child:Stack(
                      children: <Widget>[
                          Container(
                              width: double.infinity,
                              child : Image(
                                fit: BoxFit.cover ,
                                image: NetworkImage(
                                    posts[position].images[0].image_url
                                ),
                              )
                          ),
                        Align(
                            alignment: Alignment.bottomCenter,
                            child: Container(
                              padding: EdgeInsets.all(8),
                              margin: EdgeInsets.only(bottom: 10),
                              color: Colors.grey.withAlpha(100),
                              child: Text(posts[position].post_title,style: TextStyle(fontSize: 18),),
                            ),
                        ),
                      ],
                    ),
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
