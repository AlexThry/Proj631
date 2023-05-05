package Java;

import java.sql.*;

public abstract class ConnectionDatabase {


    public Connection connect() {
        try {
            //étape 1: charger la classe de driver
            Class.forName("com.mysql.jdbc.Driver");
            //étape 2: créer l'objet de connexion
            Connection conn = DriverManager.getConnection(
                    "jdbc:mysql://localhost:3306/proj631?characterEncoding=utf8", "root", "");
            return conn;
        } catch (Exception e) {
            System.out.println(e);
        }

        return null;
    }

    public void makeQuery(String query, Connection conn){
        try {
            //étape 3: créer l'objet statement
            Statement stmt = conn.createStatement();
            ResultSet res = stmt.executeQuery(query);
            //étape 4: exécuter la requête
            while (res.next())
                System.out.println(res.getString(1) + "  " + res.getString(2));
        }catch (Exception e){
            System.out.println(e);
        }
    }
    public void closeConnect(Connection conn){
        try{
            //étape 5: fermez l'objet de connexion
            conn.close();
        }catch (Exception e){
            System.out.println(e);
        }
    }



}

