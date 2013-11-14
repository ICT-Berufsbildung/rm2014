package ch.rm2014.vogler;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/thread_detail")
public class ThreadDetailServlet extends HttpServlet {

	private static final long serialVersionUID = 1L;

	protected ArrayList<Comment> getComments(Connection connection, int id)
			throws SQLException {

		PreparedStatement statement = connection
				.prepareStatement(""
						+ "SELECT c.id_comment, c.name_author, c.content, c.rating_up, c.rating_down, t.id_thread, t.name_thread "
						+ "FROM comment c INNER JOIN thread t ON t.id_thread = c.id_thread WHERE c.id_thread = ? ORDER BY t.id_thread DESC");
		statement.setInt(1, id);
		statement.execute();

		ResultSet resultSet = statement.getResultSet();

		ArrayList<Comment> comments = new ArrayList<>();
		while (resultSet.next()) {
			Comment comment = Comment.create(resultSet);
			comments.add(comment);
		}

		return comments;
	}

	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			int id = Integer.parseInt(request.getParameter("id"));

			request.setAttribute("comments", getComments(connection, id));

			getServletContext().getRequestDispatcher(
					"/WEB-INF/jsps/thread_detail.jsp").forward(request,
					response);

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			String nameAuthor = request.getParameter("name_author");
			String emailAuthor = request.getParameter("email_author");
			String content = request.getParameter("content");

			HashMap<String, String> errors = new HashMap<>();

			if (nameAuthor.equals("")) {
				errors.put("name_author", "Please enter your name");
			}

			if (emailAuthor.equals("")) {
				errors.put("email_author", "Please enter your email");
			} else if (!emailAuthor.contains("@")) {
				errors.put("email_author", "Please enter a valid email");
			}

			if (content.equals("")) {
				errors.put("content", "Please enter a comment");
			}

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			int id = Integer.parseInt(request.getParameter("id"));

			if (errors.size() > 0) {

				request.setAttribute("errors", errors);
				request.setAttribute("comments", getComments(connection, id));

				getServletContext().getRequestDispatcher(
						"/WEB-INF/jsps/thread_detail.jsp").forward(request,
						response);
				return;
			}

			PreparedStatement statement = connection
					.prepareStatement("INSERT INTO comment (name_author, email_author, content, id_thread) VALUES (?, ?, ?, ?)");
			statement.setString(1, nameAuthor);
			statement.setString(2, emailAuthor);
			statement.setString(3, content);
			statement.setInt(4, id);
			statement.execute();

			response.sendRedirect("thread_detail?id=" + id);

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
