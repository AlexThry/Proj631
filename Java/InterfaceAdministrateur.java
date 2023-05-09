package Java;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.sql.Connection;
import java.sql.ResultSet;
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
        frame.setSize(800, 500);

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
        contentPane.setLayout(new BorderLayout());

        JTabbedPane tabbedPane = new JTabbedPane();
        contentPane.add(tabbedPane, BorderLayout.CENTER);

        // Panel pour gérer les genres et les livres
        JPanel booksAndGenresPanel = new JPanel();
        booksAndGenresPanel.setLayout(new GridLayout(2, 1));
        tabbedPane.addTab("Genres et Livres", booksAndGenresPanel);

        // Panel pour ajouter et supprimer un genre
        JPanel genrePanel = new JPanel();
        booksAndGenresPanel.add(genrePanel);

        JLabel genreLabel = new JLabel("Ajouter un genre:");
        genrePanel.add(genreLabel);

        JTextField genreTextField = new JTextField(15);
        genrePanel.add(genreTextField);

        JButton addGenreButton = new JButton("Ajouter genre");
        genrePanel.add(addGenreButton);

        JLabel genreListLabel = new JLabel("Sélectionnez un genre:");
        genrePanel.add(genreListLabel);

        ArrayList<String> genres = connectionDatabase.selectGenre("SELECT label FROM genre;",connect);
        JComboBox<ArrayList<String>> genreComboBox = new JComboBox<>(genres);
        genrePanel.add(genreComboBox);

        JButton removeGenreButton = new JButton("Supprimer genre");
        genrePanel.add(removeGenreButton);

        // Panel pour ajouter et supprimer un livre
        JPanel bookPanel = new JPanel();
        booksAndGenresPanel.add(bookPanel);

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

        JComboBox<String> bookGenreComboBox = new JComboBox<>(genres);
        bookPanel.add(bookGenreComboBox);

        JLabel publicationDateLabel = new JLabel("Date de parution (JJ/MM/AAAA):");
        bookPanel.add(publicationDateLabel);

        JTextField publicationDateTextField = new JTextField(10);
        bookPanel.add(publicationDateTextField);

        JButton addBookButton = new JButton("Ajouter livre");
        bookPanel.add(addBookButton);

        JTextArea textArea = new JTextArea(10, 50);
        textArea.setEditable(false);
        JScrollPane scrollPane = new JScrollPane(textArea);
        contentPane.add(scrollPane, BorderLayout.SOUTH);

        // Panel pour gérer les utilisateurs
        JPanel usersPanel = new JPanel();
        tabbedPane.addTab("Utilisateurs", usersPanel);

        JLabel userLabel = new JLabel("Nom d'utilisateur:");
        usersPanel.add(userLabel);

        JTextField userTextField = new JTextField(15);
        usersPanel.add(userTextField);

        JButton removeUserButton = new JButton("Supprimer utilisateur");
        usersPanel.add(removeUserButton);

        JTextArea usersTextArea = new JTextArea(10, 50);
        usersTextArea.setEditable(false);
        JScrollPane usersScrollPane = new JScrollPane(usersTextArea);
        contentPane.add(usersScrollPane, BorderLayout.SOUTH);

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
        contentPane.add(reviewsScrollPane, BorderLayout.SOUTH);

        JLabel bookListLabel = new JLabel("Sélectionnez un livre:");
        bookPanel.add(bookListLabel);

        JComboBox<String> bookListComboBox = new JComboBox<>(bookTitles);
        bookPanel.add(bookListComboBox);

        JButton removeBookButton = new JButton("Supprimer livre");
        bookPanel.add(removeBookButton);

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
                if (!book.isEmpty() && !author.isEmpty() && !genre.isEmpty() && !publicationDate.isEmpty()) {
                    textArea.append("Livre ajouté: " + book + " | Auteur: " + author + " | Genre: " + genre + " | Date de parution: " + publicationDate + "\n");
                    bookTextField.setText("");
                    authorTextField.setText("");
                    bookGenreComboBox.setSelectedIndex(0);
                    publicationDateTextField.setText("");
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez entrer toutes les informations requises (titre, auteur, genre et date de parution).", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });
        removeUserButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String username = userTextField.getText();
                if (!username.isEmpty()) {
                    usersTextArea.append("Utilisateur supprimé: " + username + "\n");
                    userTextField.setText("");
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
                    textArea.append("Genre supprimé: " + selectedGenre + "\n");
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
                } else {
                    JOptionPane.showMessageDialog(frame, "Veuillez sélectionner un livre valide.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        frame.setVisible(true);
    }
}