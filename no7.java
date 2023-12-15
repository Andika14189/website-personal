import java.util.ArrayList;
import java.util.Date;
import java.util.List;

class Transaction {
    private int transactionId;
    private String customerName;
    private Date transactionDate;
    private double totalAmount;

    public Transaction(int transactionId, String customerName, Date transactionDate, double totalAmount) {
        this.transactionId = transactionId;
        this.customerName = customerName;
        this.transactionDate = transactionDate;
        this.totalAmount = totalAmount;
    }

    public int getTransactionId() {
        return transactionId;
    }

    public String getCustomerName() {
        return customerName;
    }

    public Date getTransactionDate() {
        return transactionDate;
    }

    public double getTotalAmount() {
        return totalAmount;
    }
}

class TransactionManager {
    private List<Transaction> transactions;

    public TransactionManager() {
        transactions = new ArrayList<>();
    }

    public void addTransaction(Transaction transaction) {
        transactions.add(transaction);
    }

    public double calculateTotalRevenue() {
        double totalRevenue = 0;
        for (Transaction transaction : transactions) {
            totalRevenue += transaction.getTotalAmount();
        }
        return totalRevenue;
    }

    public List<Transaction> findTransactionsByCustomerName(String customerName) {
        List<Transaction> result = new ArrayList<>();
        for (Transaction transaction : transactions) {
            if (transaction.getCustomerName().equalsIgnoreCase(customerName)) {
                result.add(transaction);
            }
        }
        return result;
    }

    public List<Transaction> findTransactionsByDate(Date date) {
        List<Transaction> result = new ArrayList<>();
        for (Transaction transaction : transactions) {
            if (transaction.getTransactionDate().equals(date)) {
                result.add(transaction);
            }
        }
        return result;
    }
}

public class ECommerceApp {
    public static void main(String[] args) {
        TransactionManager transactionManager = new TransactionManager();

        // Menambahkan transaksi baru
        Transaction transaction1 = new Transaction(1, "John Doe", new Date(), 50.0);
        Transaction transaction2 = new Transaction(2, "Jane Smith", new Date(), 75.0);
        transactionManager.addTransaction(transaction1);
        transactionManager.addTransaction(transaction2);

        // Menghitung total pendapatan dari transaksi
        double totalRevenue = transactionManager.calculateTotalRevenue();
        System.out.println("Total Revenue: $" + totalRevenue);

        // Mencari transaksi berdasarkan kriteria tertentu
        List<Transaction> transactionsByCustomerName = transactionManager.findTransactionsByCustomerName("John Doe");
        System.out.println("Transactions by customer name (John Doe):");
        for (Transaction transaction : transactionsByCustomerName) {
            System.out.println("Transaction ID: " + transaction.getTransactionId() + ", Amount: $" + transaction.getTotalAmount());
        }
    }
}
