package Java;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;

public class InterfaceAdministrateur {
    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            try {
                createAndShowGUI();
            } catch (Exception e) {
                e.printStackTrace();
            }
        });
    }

    private static void createAndShowGUI() {
        ConnectionDatabase connectionDatabase = new ConnectionDatabase();
        Connection connect = connectionDatabase.connect();
        JFrame frame = new JFrame("Interface Administrateur");
        frame.setDefaultCloseOperation(JFrame.DO_NOTHING_ON_CLOSE);
        frame.setSize(1200, 700);

        frame.addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent e) {
                try {
                    connect.close();
                } catch (SQLException ex) {
                    throw new RuntimeException(ex);
                }finally {
                    frame.dispose();
                }

            }
        });

        Container contentPane = frame.getContentPane();

        JTabbedPane tabbedPane = new JTabbedPane();
        contentPane.add(tabbedPane, BorderLayout.CENTER);

        JButton updateDb = new JButton("Update DB");
        contentPane.add(updateDb,BorderLayout.NORTH);

        // Panel pour gérer les genres et les livres
        JPanel booksAndGenresPanel = new JPanel();
        booksAndGenresPanel.setLayout(new BoxLayout(booksAndGenresPanel, BoxLayout.PAGE_AXIS));
        tabbedPane.addTab("Genres et Livres", booksAndGenresPanel);

        // Panel pour ajouter et supprimer un genre
        JPanel genrePanel = new JPanel();
        booksAndGenresPanel.add(genrePanel,BorderLayout.NORTH);

        JLabel genreLabel = new JLabel("Ajouter un genre:");
        genrePanel.add(genreLabel);

        JTextField genreTextField = new JTextField(15);
        genrePanel.add(genreTextField);

        JButton addGenreButton = new JButton("Ajouter genre");
        genrePanel.add(addGenreButton);

        JLabel genreListLabel = new JLabel("Sélectionnez un genre:");
        genrePanel.add(genreListLabel);

        ArrayList<String> genres = connectionDatabase.selectList("SELECT label FROM genre;",connect,"label");
        JComboBox genreComboBox = new JComboBox();
        for(String mot:genres) {
            genreComboBox.addItem(mot);
        }
        genrePanel.add(genreComboBox);

        JButton removeGenreButton = new JButton("Supprimer genre");
        genrePanel.add(removeGenreButton);

        // Panel pour ajouter et supprimer un livre
        JPanel bookPanel = new JPanel();
        booksAndGenresPanel.add(bookPanel,BorderLayout.SOUTH);

        JLabel bookLabel = new JLabel("Titre:");
        bookPanel.add(bookLabel);

        JTextField bookTextField = new JTextField(15);
        bookPanel.add(bookTextField);

        JLabel authorLabel = new JLabel("Auteur:");
        bookPanel.add(authorLabel);

        JTextField authorTextField = new JTextField(15);
        bookPanel.add(authorTextField);

        JLabel bookGenreLabel = new JLabel("Genre:");
        bookPanel.add(bookGenreLabel);

        JComboBox bookGenreComboBox = new JComboBox();
        for(String mot:genres) {
            bookGenreComboBox.addItem(mot);
        }
        bookPanel.add(bookGenreComboBox);

        JLabel publicationDateLabel = new JLabel("Date de parution (AAAA/MM/JJ):");
        bookPanel.add(publicationDateLabel);

        JTextField publicationDateTextField = new JTextField(15);
        bookPanel.add(publicationDateTextField);


        JLabel bookDescLabel = new JLabel("Description :");
        bookPanel.add(bookDescLabel);

        JTextField bookDescField = new JTextField(15);
        bookPanel.add(bookDescField);

        JButton addBookButton = new JButton("Ajouter livre");
        bookPanel.add(addBookButton);

        // Suppression de livre
        JPanel bookDeletePanel = new JPanel();

        JLabel bookListLabel = new JLabel("Sélectionnez un livre:");
        ArrayList<String> livres = connectionDatabase.selectList("SELECT title FROM book;",connect,"title");
        JComboBox bookListComboBox = new JComboBox();
        for(String mot:livres) {
            bookListComboBox.addItem(mot);
        }
        bookDeletePanel.add(bookListLabel);

        bookDeletePanel.add(bookListComboBox);

        JButton removeBookButton = new JButton("Supprimer livre");
        bookDeletePanel.add(removeBookButton);

        booksAndGenresPanel.add(bookDeletePanel,BorderLayout.CENTER);

        // TODO : Sa sert à quoi ça Arthur ptn
        JTextArea textArea = new JTextArea(10, 50);
        textArea.setEditable(false);

        JScrollPane scrollPane = new JScrollPane(textArea);
        bookPanel.add(scrollPane, BorderLayout.SOUTH);

        // Panel pour gérer les utilisateurs
        JPanel usersPanel = new JPanel();
        tabbedPane.addTab("Utilisateurs", usersPanel);

        JLabel userLabel = new JLabel("Nom d'utilisateur:");
        usersPanel.add(userLabel);
        ArrayList<String> users = connectionDatabase.selectList("SELECT user_name FROM user;",connect,"user_name");
        JComboBox userListComboBox = new JComboBox();
        for(String mot:users) {
            userListComboBox.addItem(mot);
        }
        usersPanel.add(userListComboBox);

        JButton removeUserButton = new JButton("Supprimer utilisateur");
        usersPanel.add(removeUserButton);

        JTextArea usersTextArea = new JTextArea(10, 50);
        usersTextArea.setEditable(false);
        JScrollPane usersScrollPane = new JScrollPane(usersTextArea);
        usersPanel.add(usersScrollPane, BorderLayout.SOUTH);

        JPanel removeReviewPanel = new JPanel();
        tabbedPane.addTab("Supprimer Avis", removeReviewPanel);

        JLabel bookTitleLabel = new JLabel("Titre du livre:");
        removeReviewPanel.add(bookTitleLabel);

        String[] bookTitles = new String[0];
        JComboBox<String> bookTitleComboBox = new JComboBox<>(bookTitles);
        removeReviewPanel.add(bookTitleComboBox);

        JLabel reviewerNameLabel = new JLabel("Nom d'utilisateur:");
        removeReviewPanel.add(reviewerNameLabel);

        JTextField reviewerNameTextField = new JTextField(15);
        removeReviewPanel.add(reviewerNameTextField);

        JButton removeReviewButton = new JButton("Supprimer Avis");
        removeReviewPanel.add(removeReviewButton);

        JTextArea reviewsTextArea = new JTextArea(10, 50);
        reviewsTextArea.setEditable(false);
        JScrollPane reviewsScrollPane = new JScrollPane(reviewsTextArea);
        removeReviewPanel.add(reviewsScrollPane, BorderLayout.SOUTH);

// Panel pour gérer les cercles
        JPanel circlesPanel = new JPanel();
        tabbedPane.addTab("Cercles", circlesPanel);

        JLabel circleLabel = new JLabel("Nom du cercle:");
        circlesPanel.add(circleLabel);
        ArrayList<String> circles = connectionDatabase.selectList("SELECT title FROM circle;",connect,"title");
        JComboBox circleListComboBox = new JComboBox();
        for(String mot:circles) {
            circleListComboBox.addItem(mot);
        }
        circlesPanel.add(circleListComboBox);

        JButton removeCircleButton = new JButton("Supprimer cercle");
        circlesPanel.add(removeCircleButton);

        JTextArea circlesTextArea = new JTextArea(10, 50);
        circlesTextArea.setEditable(false);
        JScrollPane circlesScrollPane = new JScrollPane(circlesTextArea);
        circlesPanel.add(circlesScrollPane, BorderLayout.SOUTH);

        addGenreButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String genre = genreTextField.getText();
                if (!genre.isEmpty()) {
                    String sql = "INSERT INTO genre (label) " +
                            "VALUES ('"+genre+"');";
                    connectionDatabase.insert(sql,connect);
                    textArea.append("Genre ajouté: " + genre + "\n");
                    genreTextField.setText("");
                    createAndShowGUI();
                    frame.dispose();
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un genre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        addBookButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String book = bookTextField.getText();
                String author = authorTextField.getText();
                String genre = (String) bookGenreComboBox.getSelectedItem();
                String publicationDate = publicationDateTextField.getText();
                String description = bookDescField.getText();
                if (!book.isEmpty() && !author.isEmpty()  && !publicationDate.isEmpty()) {
                    textArea.append("Livre ajouté: " + book + " | Auteur: " + author + " | Genre: " + genre + " | Date de parution: " + publicationDate + "\n");
                    bookTextField.setText("");
                    authorTextField.setText("");
                    bookGenreComboBox.setSelectedIndex(0);
                    publicationDateTextField.setText("");
                    //on fait les requete pour ajouté le livre et l'associé à un genre
                    String sqlAddBook = "INSERT INTO book (title , author, parution_date,image_url,description) VALUES(\"" +book+"\",\""+author+"\",\""+publicationDate+"\",\"www.test.fr\",\""+description+"\");";
                    connectionDatabase.insert(sqlAddBook,connect);
                    String sqlIdBook = "SELECT id FROM book  where title='"+book+"'AND author='"+author+"';";
                    String idBook = connectionDatabase.selectList(sqlIdBook, connect,"id").get(0);
                    String sqlIdGenre = "SELECT id FROM genre  where label='"+genre+"';";
                    String idGenre = connectionDatabase.selectList(sqlIdGenre, connect,"id").get(0);
                    String sqladdHasGenre = "INSERT INTO has_genre (id_book,id_genre) VALUES('"+idBook+"','"+idGenre+"');";
                    connectionDatabase.insert(sqladdHasGenre,connect);
                    createAndShowGUI();
                    frame.dispose();
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer toutes les informations requises (titre, auteur, genre et date de parution).", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });
        removeUserButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String username = (String) userListComboBox.getSelectedItem();
                if (!username.isEmpty()) {
                    connectionDatabase.delete("DELETE FROM user WHERE user_name = '"+username+"';",connect);
                    usersTextArea.append("Utilisateur supprimé: " + username + "\n");

                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un nom d'utilisateur valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        removeReviewButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String bookTitle = (String) bookTitleComboBox.getSelectedItem();
                String reviewerName = reviewerNameTextField.getText();
                if (bookTitle != null && !reviewerName.isEmpty()) {
                    reviewsTextArea.append("Avis supprimé pour le livre \"" + bookTitle + "\" de l'utilisateur \"" + reviewerName + "\"\n");
                    reviewerNameTextField.setText("");
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un livre et entrer un nom d'utilisateur valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });
        removeGenreButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String selectedGenre = (String) genreComboBox.getSelectedItem();
                if (selectedGenre != null) {
                    // Supprimez le genre sélectionné de vos données et mettez à jour le menu déroulant des genres
                    connectionDatabase.delete("DELETE FROM genre WHERE label = '"+selectedGenre+"';",connect);
                    textArea.append("Genre supprimé: " + selectedGenre + "\n");
                    createAndShowGUI();
                    frame.dispose();
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un genre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        removeBookButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String selectedBook = (String) bookListComboBox.getSelectedItem();
                if (selectedBook != null) {
                    // Supprimez le livre sélectionné de vos données et mettez à jour le menu déroulant des livres
                    textArea.append("Livre supprimé: " + selectedBook + "\n");
                    String sqlIdBook = "SELECT id FROM book  where title='"+selectedBook+"';";
                    String idBook = connectionDatabase.selectList(sqlIdBook, connect,"id").get(0);
                    connectionDatabase.delete("DELETE FROM book WHERE title = '"+selectedBook+"';",connect);
                    connectionDatabase.delete("DELETE FROM has_genre WHERE id_book = '"+idBook+"';",connect);
                    createAndShowGUI();
                    frame.dispose();
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un livre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        updateDb.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                createAndShowGUI();
                frame.dispose();
            }
        });

        removeCircleButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String circleName = (String) circleListComboBox.getSelectedItem();
                if (!circleName.isEmpty()) {
                    connectionDatabase.delete("DELETE FROM circle WHERE title = '"+circleName+"';",connect);
                    circlesTextArea.append("Cercle supprimé: " + circleName + "\n");
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer un nom de cercle valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
                createAndShowGUI();
                frame.dispose();
            }
        });

        frame.setVisible(true);
    }
}